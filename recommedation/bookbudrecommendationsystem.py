import pandas as pd
import numpy as np
import seaborn as sns
from matplotlib import pyplot as plt
sns.set_style('whitegrid')
import re
import json
import string
import spacy
from nltk.corpus import stopwords
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.cluster import KMeans
from kneed import KneeLocator
from collections import Counter
from itertools import chain
import warnings
from IPython.display import clear_output
warnings.filterwarnings("ignore")
import nltk
nltk.download('stopwords')
import ast

dataset = 'SoftwareData.csv'
from nltk.corpus import stopwords
stopwords = set(stopwords.words('english'))
punctuation = string.punctuation + '—'
min_rating = 2000000
nlp = spacy.load("en_core_web_sm")
vectorizer = TfidfVectorizer()
kmeans_params = {
    'init': 'random',
    'n_init': 10,
    'max_iter': 300,
    'random_state': 42
}
sse = []
n_k = range(1, 41)

df = pd.read_csv(dataset)

def strip_html(text):
    clean = re.compile('<.*?>')
    return re.sub(clean, '', text)

def remove_stopwords(text):
    text = text.split()
    text = [word for word in text if word not in stopwords]
    return ' '.join(text)

def remove_digits(text):
    text = re.sub(r'[0-9]', '', text)
    return text

def remove_punctuation(text):
    text = ''.join([word for word in text if word not in punctuation])
    return text

def get_keywords(text):
    doc = nlp(text)
    return ' '.join([item.text.strip() for item in doc.ents])

def parse_text(text):
    text = text.lower()
    text = strip_html(text)
    text = remove_stopwords(text)
    text = remove_digits(text)
    text = remove_punctuation(text)
    text = get_keywords(text)
    return text

df['keywords'] = df['description'].apply(parse_text)

df['genres'] = df['genres'].apply(lambda x: str(["{}".format(genre.strip()) for genre in x.split(',')]))
df['genres'] = df['genres'].apply(lambda x: ast.literal_eval(x) if isinstance(x, str) else x)
df['genres'] = df['genres'].apply(lambda x: ', '.join(x) if isinstance(x, list) else x)
def add_hyphens(genre_string):
    return ", ".join([genre.replace(" ", "-") for genre in genre_string.split(", ")])
df['hyphenated_genres'] = df['genres'].apply(add_hyphens)
features = ['ID','title', 'author', 'genres', 'keywords']
final_df = df.loc[:, features]
def transform_genres(genre_string):
    genres_transformed = [genre.strip().replace(" ", "-") for genre in genre_string.split(",")]
    return " ".join(genres_transformed)

final_df['genres'] = final_df['genres'].apply(transform_genres)
final_df['keywords'] = final_df['keywords'].astype(str).apply(lambda x: ' '.join(x.split()))

final_df['corpus'] =  final_df[['genres', 'keywords']].agg(' '.join, axis=1).str.lower()

tfidf = vectorizer.fit_transform(final_df['corpus'])

from sklearn.decomposition import TruncatedSVD
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.feature_extraction.text import TfidfVectorizer

vectorizer = TfidfVectorizer(max_features=10000) 
X = vectorizer.fit_transform(final_df['corpus'])

svd = TruncatedSVD(n_components=300) 
X_reduced = svd.fit_transform(X)

cosine_sim = cosine_similarity(X_reduced)

for k in n_k:
    kmeans = KMeans(n_clusters=k, **kmeans_params).fit(tfidf)
    sse.append(kmeans.inertia_)
print(len(n_k), len(sse))

import matplotlib.pyplot as plt
from kneed import KneeLocator

n_k = range(1, len(sse)+1)  

plt.figure(figsize=(10, 6))
plt.plot(n_k, sse, marker='o')
plt.title('Elbow Method For Optimal k')
plt.xlabel('Number of clusters, k')
plt.ylabel('SSE')
plt.xticks(list(n_k))  
locator = KneeLocator(list(n_k), sse, curve='convex', direction='decreasing')
plt.axvline(x=locator.elbow, linestyle='--', color='r', label=f'Elbow at k={locator.elbow}')
plt.legend()
plt.savefig('elbow_method_plot.png', format='png', dpi=300)
plt.show(block=False)

kmeans = KMeans(n_clusters=locator.elbow, **kmeans_params)
kmeans.fit(cosine_sim)
final_df['cluster'] = kmeans.labels_
final_df.head()

plt.figure(figsize=(15,8))
output = plt.scatter(cosine_sim[:,0], cosine_sim[:,1], c=final_df.cluster, marker='o', alpha=1, cmap='mako')
centers = kmeans.cluster_centers_
plt.scatter(centers[:,0], centers[:,1], c='red', s=100, alpha=1 , marker='o')
plt.colorbar(output)
plt.savefig('cluster_scatter_plot.png', format='png', dpi=300)
plt.show(block=False)

book_map = {title: idx for idx, title in enumerate(final_df['title'])}
def get_recommendation(title, top_n=11):
    book_id = book_map[title]

    sim_score = list(enumerate(cosine_sim[book_id]))
    sim_score = sorted(sim_score, key=lambda x: x[1], reverse=True)
    sim_score = sim_score[:top_n]

    book_indices = [score[0] for score in sim_score]
    scores = [score[1] for score in sim_score]
    top_n_recommendation = final_df[['ID','title', 'author', 'genres']].iloc[book_indices]
    top_n_recommendation['genres'] = top_n_recommendation['genres'].apply(lambda x: x.split())
    top_n_recommendation['score'] = scores
    return top_n_recommendation.iloc[1:]

eval_title = 'Death by Bikini'
high_score = get_recommendation(eval_title)
print(high_score)

import pickle

with open('vectorizer.pkl', 'wb') as f:
    pickle.dump(vectorizer, f)

with open('svd_model.pkl', 'wb') as f:
    pickle.dump(svd, f)

with open('kmeans_model.pkl', 'wb') as f:
    pickle.dump(kmeans, f)

with open('cosine_similarity.pkl', 'wb') as f:
    pickle.dump(cosine_sim, f)

final_df.to_pickle('final_df.pkl')

with open('book_map.pkl', 'wb') as f:
    pickle.dump(book_map, f)
