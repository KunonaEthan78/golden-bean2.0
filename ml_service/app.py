from flask import Flask, request, jsonify
import pandas as pd
from sklearn.cluster import KMeans
from sklearn.preprocessing import StandardScaler
from sklearn.linear_model import LinearRegression
import joblib
import os

app = Flask(__name__)

@app.route('/predict-demand', methods=['POST'])
def predict_demand():
    data = pd.DataFrame(request.json['sales'])
    # Aggregate sales by month
    data['order_date'] = pd.to_datetime(data['order_date'])
    monthly = data.groupby(data['order_date'].dt.to_period('M')).agg({'quantity':'sum'}).reset_index()
    monthly['order_date'] = monthly['order_date'].dt.to_timestamp()
    # Train model
    X = (monthly['order_date'] - monthly['order_date'].min()).dt.days.values.reshape(-1,1)
    y = monthly['quantity'].values
    model = LinearRegression().fit(X, y)
    # Predict next 3 months
    future_days = [(monthly['order_date'].max() - monthly['order_date'].min()).days + 30*i for i in range(1,4)]
    preds = model.predict([[d] for d in future_days])
    return jsonify({'future_months': future_days, 'predicted_quantities': preds.tolist()})

@app.route('/segment-customers', methods=['POST'])
def segment_customers():
    data = pd.DataFrame(request.json['sales'])
    # Aggregate by user
    user_data = data.groupby('user_id').agg({'quantity':'sum', 'price':'sum'}).reset_index()
    scaler = StandardScaler()
    X_scaled = scaler.fit_transform(user_data[['quantity', 'price']])
    kmeans = KMeans(n_clusters=3, random_state=42).fit(X_scaled)
    user_data['segment'] = kmeans.labels_
    return jsonify(user_data[['user_id', 'segment']].to_dict(orient='records'))

if __name__ == '__main__':
    app.run(port=5001)