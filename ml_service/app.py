from flask import Flask, request, jsonify, send_file
import pandas as pd
from sklearn.cluster import KMeans
from sklearn.preprocessing import StandardScaler
from sklearn.linear_model import LinearRegression
import joblib
import os
import matplotlib.pyplot as plt
import seaborn as sns
import base64
from io import BytesIO
import numpy as np

app = Flask(__name__)

# Set matplotlib to use a non-interactive backend
plt.switch_backend('Agg')
# Set the style for better-looking plots
try:
    plt.style.use('seaborn-v0_8')
except:
    # Fallback for older matplotlib versions
    try:
        plt.style.use('seaborn')
    except:
        plt.style.use('default')
        
sns.set_palette("husl")

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
    
    # Create visualization
    plt.figure(figsize=(12, 6))
    plt.plot(monthly['order_date'], y, 'o-', label='Historical Sales', linewidth=2, markersize=8)
    
    # Create future dates for plotting
    future_dates = [monthly['order_date'].max() + pd.DateOffset(months=i) for i in range(1,4)]
    plt.plot(future_dates, preds, 's--', label='Predicted Sales', linewidth=2, markersize=10, color='red')
    
    plt.title('Coffee Sales Demand Prediction', fontsize=16, fontweight='bold')
    plt.xlabel('Date', fontsize=12)
    plt.ylabel('Quantity Sold', fontsize=12)
    plt.legend(fontsize=12)
    plt.grid(True, alpha=0.3)
    plt.xticks(rotation=45)
    plt.tight_layout()
    
    # Convert plot to base64 string
    img_buffer = BytesIO()
    plt.savefig(img_buffer, format='png', dpi=300, bbox_inches='tight')
    img_buffer.seek(0)
    img_str = base64.b64encode(img_buffer.read()).decode()
    plt.close()
    
    return jsonify({
        'future_months': future_days, 
        'predicted_quantities': preds.tolist(),
        'chart': img_str,
        'historical_data': {
            'dates': monthly['order_date'].dt.strftime('%Y-%m-%d').tolist(),
            'quantities': y.tolist()
        }
    })

@app.route('/segment-customers', methods=['POST'])
def segment_customers():
    data = pd.DataFrame(request.json['sales'])
    # Aggregate by user
    user_data = data.groupby('user_id').agg({'quantity':'sum', 'price':'sum'}).reset_index()
    scaler = StandardScaler()
    X_scaled = scaler.fit_transform(user_data[['quantity', 'price']])
    kmeans = KMeans(n_clusters=3, random_state=42).fit(X_scaled)
    user_data['segment'] = kmeans.labels_
    
    # Create visualization
    plt.figure(figsize=(15, 5))
    
    # Subplot 1: Scatter plot of customers by quantity and price
    plt.subplot(1, 3, 1)
    colors = ['#FF6B6B', '#4ECDC4', '#45B7D1']
    segment_names = ['Low Value', 'Medium Value', 'High Value']
    
    for i in range(3):
        segment_data = user_data[user_data['segment'] == i]
        plt.scatter(segment_data['quantity'], segment_data['price'], 
                   c=colors[i], label=segment_names[i], alpha=0.7, s=60)
    
    plt.xlabel('Total Quantity Purchased', fontsize=10)
    plt.ylabel('Total Amount Spent ($)', fontsize=10)
    plt.title('Customer Segmentation', fontsize=12, fontweight='bold')
    plt.legend()
    plt.grid(True, alpha=0.3)
    
    # Subplot 2: Segment distribution pie chart
    plt.subplot(1, 3, 2)
    segment_counts = user_data['segment'].value_counts().sort_index()
    plt.pie(segment_counts.values, labels=[segment_names[i] for i in segment_counts.index], 
            colors=colors, autopct='%1.1f%%', startangle=90)
    plt.title('Customer Distribution', fontsize=12, fontweight='bold')
    
    # Subplot 3: Average metrics by segment
    plt.subplot(1, 3, 3)
    segment_stats = user_data.groupby('segment')[['quantity', 'price']].mean()
    x = np.arange(len(segment_stats))
    width = 0.35
    
    plt.bar(x - width/2, segment_stats['quantity'], width, label='Avg Quantity', color=colors[0], alpha=0.7)
    plt.bar(x + width/2, segment_stats['price']/10, width, label='Avg Spend (÷10)', color=colors[1], alpha=0.7)
    
    plt.xlabel('Customer Segments', fontsize=10)
    plt.ylabel('Average Values', fontsize=10)
    plt.title('Segment Comparison', fontsize=12, fontweight='bold')
    plt.xticks(x, [segment_names[i] for i in segment_stats.index])
    plt.legend()
    plt.grid(True, alpha=0.3)
    
    plt.tight_layout()
    
    # Convert plot to base64 string
    img_buffer = BytesIO()
    plt.savefig(img_buffer, format='png', dpi=300, bbox_inches='tight')
    img_buffer.seek(0)
    img_str = base64.b64encode(img_buffer.read()).decode()
    plt.close()
    
    # Calculate segment statistics
    segment_summary = []
    for i in range(3):
        seg_data = user_data[user_data['segment'] == i]
        segment_summary.append({
            'segment': segment_names[i],
            'count': len(seg_data),
            'avg_quantity': float(seg_data['quantity'].mean()),
            'avg_spending': float(seg_data['price'].mean()),
            'total_revenue': float(seg_data['price'].sum())
        })
    
    return jsonify({
        'customers': user_data[['user_id', 'segment']].to_dict(orient='records'),
        'chart': img_str,
        'segment_summary': segment_summary
    })

@app.route('/sales-dashboard', methods=['POST'])
def sales_dashboard():
    data = pd.DataFrame(request.json['sales'])
    data['order_date'] = pd.to_datetime(data['order_date'])
    
    # Create comprehensive dashboard
    _, ((ax1, ax2), (ax3, ax4)) = plt.subplots(2, 2, figsize=(16, 12))
    
    # 1. Daily sales trend
    daily_sales = data.groupby(data['order_date'].dt.date)['quantity'].sum()
    ax1.plot(daily_sales.index, daily_sales.values, marker='o', linewidth=2)
    ax1.set_title('Daily Sales Trend', fontsize=14, fontweight='bold')
    ax1.set_xlabel('Date')
    ax1.set_ylabel('Quantity Sold')
    ax1.grid(True, alpha=0.3)
    ax1.tick_params(axis='x', rotation=45)
    
    # 2. Revenue over time
    daily_revenue = data.groupby(data['order_date'].dt.date)['price'].sum()
    ax2.bar(daily_revenue.index, daily_revenue.values, alpha=0.7, color='green')
    ax2.set_title('Daily Revenue', fontsize=14, fontweight='bold')
    ax2.set_xlabel('Date')
    ax2.set_ylabel('Revenue ($)')
    ax2.tick_params(axis='x', rotation=45)
    
    # 3. Top customers by spending
    top_customers = data.groupby('user_id')['price'].sum().nlargest(10)
    ax3.barh(range(len(top_customers)), top_customers.values, color='purple', alpha=0.7)
    ax3.set_title('Top 10 Customers by Spending', fontsize=14, fontweight='bold')
    ax3.set_xlabel('Total Spending ($)')
    ax3.set_ylabel('Customer ID')
    ax3.set_yticks(range(len(top_customers)))
    ax3.set_yticklabels([f'Customer {id}' for id in top_customers.index])
    
    # 4. Monthly comparison
    data['month'] = data['order_date'].dt.to_period('M')
    monthly_summary = data.groupby('month').agg({
        'quantity': 'sum',
        'price': 'sum'
    }).reset_index()
    
    x_pos = np.arange(len(monthly_summary))
    ax4_twin = ax4.twinx()
    
    ax4.bar(x_pos - 0.2, monthly_summary['quantity'], 0.4, 
                   label='Quantity', color='skyblue', alpha=0.7)
    ax4_twin.bar(x_pos + 0.2, monthly_summary['price'], 0.4, 
                        label='Revenue', color='lightcoral', alpha=0.7)
    
    ax4.set_title('Monthly Sales & Revenue', fontsize=14, fontweight='bold')
    ax4.set_xlabel('Month')
    ax4.set_ylabel('Quantity', color='skyblue')
    ax4_twin.set_ylabel('Revenue ($)', color='lightcoral')
    ax4.set_xticks(x_pos)
    ax4.set_xticklabels([str(m) for m in monthly_summary['month']], rotation=45)
    
    # Add legends
    lines1, labels1 = ax4.get_legend_handles_labels()
    lines2, labels2 = ax4_twin.get_legend_handles_labels()
    ax4.legend(lines1 + lines2, labels1 + labels2, loc='upper left')
    
    plt.tight_layout()
    
    # Convert to base64
    img_buffer = BytesIO()
    plt.savefig(img_buffer, format='png', dpi=300, bbox_inches='tight')
    img_buffer.seek(0)
    img_str = base64.b64encode(img_buffer.read()).decode()
    plt.close()
    
    # Calculate summary statistics
    total_sales = data['quantity'].sum()
    total_revenue = data['price'].sum()
    avg_order_value = data['price'].mean()
    unique_customers = data['user_id'].nunique()
    
    return jsonify({
        'dashboard_chart': img_str,
        'summary_stats': {
            'total_sales': int(total_sales),
            'total_revenue': float(total_revenue),
            'average_order_value': float(avg_order_value),
            'unique_customers': int(unique_customers),
            'sales_period': {
                'start_date': data['order_date'].min().strftime('%Y-%m-%d'),
                'end_date': data['order_date'].max().strftime('%Y-%m-%d')
            }
        }
    })

@app.route('/analytics-report', methods=['POST'])
def analytics_report():
    """Generate a comprehensive analytics report with multiple visualizations"""
    data = pd.DataFrame(request.json['sales'])
    data['order_date'] = pd.to_datetime(data['order_date'])
    
    # Get individual analytics
    demand_result = predict_demand()
    segmentation_result = segment_customers()
    dashboard_result = sales_dashboard()
    
    return jsonify({
        'demand_prediction': demand_result.get_json(),
        'customer_segmentation': segmentation_result.get_json(),
        'sales_dashboard': dashboard_result.get_json(),
        'report_generated_at': pd.Timestamp.now().strftime('%Y-%m-%d %H:%M:%S')
    })

if __name__ == '__main__':
    app.run(port=5001)