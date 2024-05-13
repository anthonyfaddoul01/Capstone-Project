import pickle
import pandas as pd
from flask import Flask, request, jsonify
from flask_cors import CORS
import numpy as np
import sqlite3
import logging

logging.basicConfig(level=logging.DEBUG)

app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": "*"}}) 

import mysql.connector

def get_data_from_db():
    try:
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='bookbud'
        )
        cursor = conn.cursor()
        cursor.execute("SELECT bookId, title, author, genres, rating, numRating, reservedNb, mainGenre FROM book")
        data = cursor.fetchall()
        return data
    except mysql.connector.Error as err:
        print("Something went wrong: {}".format(err))
        return None
    finally:
        if conn.is_connected():
            cursor.close()
            conn.close()
            print("Connection is closed")
 
def get_record_from_db():
    try:
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='bookbud'
        )
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM record")
        data = cursor.fetchall()
        return data
    except mysql.connector.Error as err:
        print("Something went wrong: {}".format(err))
        return None
    finally:
        if conn.is_connected():
            cursor.close()
            conn.close()
            print("Connection is closed")


with open('vectorizer.pkl', 'rb') as f:
    vectorizer = pickle.load(f)

with open('svd_model.pkl', 'rb') as f:
    svd = pickle.load(f)

with open('kmeans_model.pkl', 'rb') as f:
    kmeans = pickle.load(f)

with open('cosine_similarity.pkl', 'rb') as f:
    cosine_sim = pickle.load(f)

final_df = pd.read_pickle('final_df.pkl')

with open('book_map.pkl', 'rb') as f:
    book_map = pickle.load(f)

def get_recommendation(title, top_n=11):
    # get index from input title
    book_id = book_map[title]

    # calculate similarity score, sort value descending and get top_n book
    sim_score = list(enumerate(cosine_sim[book_id]))
    sim_score = sorted(sim_score, key=lambda x: x[1], reverse=True)
    sim_score = sim_score[:top_n]

    # get book index from top_n recommendation
    book_indices = [score[0] for score in sim_score]
    scores = [score[1] for score in sim_score]
    top_n_recommendation = final_df[['ID','title', 'author', 'genres']].iloc[book_indices]
    top_n_recommendation['score'] = scores
    return top_n_recommendation.iloc[1:]


@app.route('/genre', methods=['GET'])
def genre():
    data = get_data_from_db()
    if data is None:
        return jsonify({"error": "Failed to retrieve data from the database"}), 500
    
    df = pd.DataFrame(data, columns=['bookId', 'title', 'author', 'genres', 'rating', 'numRating', 'reservedNb', 'mainGenre'])
    w1, w2, w3 = 0.5, 0.25, 0.25

    df['rating'] = df['rating'].astype(float)
    df['numRating'] = df['numRating'].astype(float)
    df['reservedNb'] = df['reservedNb'].astype(float)

    max_rating = df['rating'].max() if df['rating'].max() > 0 else 1
    max_numRating = df['numRating'].max() if df['numRating'].max() > 0 else 1
    max_reservedNb = df['reservedNb'].max() if df['reservedNb'].max() > 0 else 1

    def compute_popularity_score(row):
        normalized_rating = row['rating'] / max_rating if max_rating > 0 else 0
        normalized_numRating = row['numRating'] / max_numRating if max_numRating > 0 else 0
        normalized_reservedNb = row['reservedNb'] / max_reservedNb if max_reservedNb > 0 else 0
        score = (w1 * normalized_rating) + (w2 * normalized_numRating) + (w3 * normalized_reservedNb)
        return score * 100  # Convert score to percentage

    df['popularityScore'] = df.apply(compute_popularity_score, axis=1)
    
    genre_popularity = df.groupby('mainGenre')['popularityScore'].sum()

    # Normalize total popularity score for all genres to sum up to 100
    total_popularity_sum = genre_popularity.sum()
    genre_popularity = genre_popularity * (100 / total_popularity_sum)

    top_genres = genre_popularity.nlargest(10).index.tolist()

    genre_book_details = {}
    
    for genre in top_genres:
        genre_df = df[df['mainGenre'] == genre]
        top_books = genre_df.nlargest(10, 'popularityScore')[['title', 'author', 'popularityScore']]
        genre_book_details[genre] = {
            'books': top_books.to_dict('records'),
            'total_popularity': genre_popularity.loc[genre]
        }

    return jsonify(genre_book_details)


@app.route('/recommend', methods=['GET'])
def recommend():
    title = request.args.get('title', '')
    if not title:
        return jsonify({'error': 'Missing title parameter'}), 400

    try:
        recommendations = get_recommendation(title)
        response_data = recommendations.to_dict(orient='records')
        #print("Sending response data:", response_data)  # Debug output
        return jsonify(response_data)
    except Exception as e:
        return jsonify({'error': str(e)}), 500
    

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
