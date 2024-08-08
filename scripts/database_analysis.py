import mysql.connector
import pandas as pd
import plotly.express as px

# Database connection details
host = '127.0.0.1'
port = 3306
user = 'root'
password = ''
database = 'mis'

# Establish a connection to the database
conn = mysql.connector.connect(
    host=host,
    port=port,
    user=user,
    password=password,
    database=database
)

# Create a cursor object
cursor = conn.cursor()

# SQL query to fetch data from the user table
query = "SELECT * FROM user"

# Execute the query
cursor.execute(query)

# Fetch all rows from the executed query
rows = cursor.fetchall()

# Get column names
column_names = [i[0] for i in cursor.description]

# Close the cursor and connection
cursor.close()
conn.close()

# Create a DataFrame from the fetched data
df = pd.DataFrame(rows, columns=column_names)

# Generate Plotly pie chart
if 'active' in df.columns:
    active_counts = df['active'].value_counts()
    fig = px.pie(values=active_counts, names=['Inactive', 'Active'], title='Active vs Inactive Users')
    fig.update_layout(margin=dict(t=0, b=0, l=0, r=0))

    # Generate HTML for the plot
    plot_html = fig.to_html(full_html=False)
    print(plot_html)