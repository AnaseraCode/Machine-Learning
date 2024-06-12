import pandas as pd
from sklearn.preprocessing import LabelEncoder, MinMaxScaler
from sklearn.model_selection import train_test_split
from sklearn.neighbors import KNeighborsClassifier
import joblib

# Load data
df = pd.read_csv('dataset/mushroom_cleaned.csv')

# Clean data by dropping rows with missing values
df = df.dropna()

# Initialize the LabelEncoder
le = LabelEncoder()

# List of columns to encode
columns_to_encode = ['cap-shape', 'gill-attachment', 'gill-color', 'stem-color', 'season', 'class']

# Apply LabelEncoder to each column
for column in columns_to_encode:
    df[column] = le.fit_transform(df[column])

# Separation of features and labels
features = df[df.columns.difference(['class'])]  # Assuming 'class' is the label
label = df['class']

# Split the dataset into training (70%) and testing (30%) data
X_train, X_test, y_train, y_test = train_test_split(features, label, test_size=0.3, random_state=1)

# Feature scaling using Min-Max scaler to normalize feature range to (0, 50)
scaler = MinMaxScaler(feature_range=(0, 50))
scaler.fit(X_train)
X_train = scaler.transform(X_train)
X_test = scaler.transform(X_test)

# Train the KNN model
knn_classifier = KNeighborsClassifier()
knn_classifier.fit(X_train, y_train)

# Save the KNN model and scaler
joblib.dump(knn_classifier, 'model/mushroom_knn_model.sav')
joblib.dump(scaler, 'model/scaler_knn.sav')

# Print to confirm the script executed successfully
print("KNN model and scaler have been saved successfully.")