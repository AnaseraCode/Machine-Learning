<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">

    <div class="bg-gray-800 p-10 rounded-lg shadow-2xl w-full max-w-md">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">Upload Your File</h2>
        <form action="" method="post" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label class="block text-gray-400 font-semibold mb-2">Choose File:</label>
                <input type="file" name="berkas" class="block w-full border border-gray-600 rounded-lg p-2 bg-gray-700 text-white focus:border-red-500 focus:ring focus:ring-red-200 transition duration-200">
            </div>
            <div class="flex justify-center">
                <button type="submit" name="upload" class="bg-red-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-800 transition duration-200">
                    Upload
                </button>
            </div>
        </form>

        <?php
        function panggil_model(){
            $perintah = "python C:\\xampp\\htdocs\\machine_learning\\e-nose.py";
            $output = shell_exec($perintah);
            return "$output";
        }

        if(isset($_POST["upload"])) {
            $namaFile = 'dataset.csv';
            $namaSementara = $_FILES['berkas']['tmp_name'];
            $dirUpload = "dataset/";
            $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

            echo '<div class="mt-6">';
            if ($terupload) {
                echo "<p class='text-green-400 font-semibold'>Upload successful!</p>";
                echo "<p class='text-white'>Dataset link: <a href='".$dirUpload.$namaFile."' class='text-blue-400 underline'>".$namaFile."</a></p>";
                $hasil = panggil_model();
                echo "<p class='text-white'>Prediction result: ".$hasil."</p>";
                echo "<p class='text-white'>Result link: <a href='hasil.csv' class='text-blue-400 underline'>hasil.csv</a></p>";
            } else {
                echo "<p class='text-red-400 font-semibold'>Upload failed!</p>";
            }
            echo '</div>';
        }
        ?>
    </div>

</body>
</html>