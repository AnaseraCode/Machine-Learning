import joblib
import pandas as pd
from sklearn.preprocessing import LabelEncoder

# Update directory path
dir_path = ''

# Load the classification model
model_bank_classification = dir_path + 'model/mushroom_knn_model.sav'
classifier_bank = joblib.load(model_bank_classification)

# Load the scaler
scaler_bank_dir = dir_path + 'model/scaler_knn.sav'
scaler_bank = joblib.load(scaler_bank_dir)

# Load the data
data_file = pd.read_csv(dir_path + 'dataset/mushroom_cleaned.csv')

# Cleaning the data by dropping rows with missing values
data_file = data_file.dropna()

# Encoding features
# Assuming that you've saved the LabelEncoder for the same columns from the training phase
# Let's use the column names you trained on before
columns_to_encode = ['cap-shape', 'gill-attachment', 'gill-color', 'stem-color', 'season']

# Initialize the LabelEncoder
le = LabelEncoder()

# Apply LabelEncoder to each column
for column in columns_to_encode:
    data_file[column] = le.fit_transform(data_file[column])

# Exclude the 'class' column if it exists (you should only have feature columns in your new data)
features = data_file[data_file.columns.difference(['class'])]

# Perform feature scaling using the loaded scaler
scaled_features = scaler_bank.transform(features)

# Predict using the loaded model
results = classifier_bank.predict(scaled_features)

# Save the prediction results to a CSV file
results_df = pd.DataFrame(results, columns=['Prediction'])
results_df.to_csv(dir_path + 'hasil.csv', index=False)

# Print the results
print(results_df)