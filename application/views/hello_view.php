<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS untuk memusatkan teks */
        h1 {
            text-align: center; /* Memusatkan teks */
            margin-top: 50px;  /* Menambahkan jarak di atas */
        }
    </style>
</head>
<body>
<div class="container">
        <h1 class="mt-5">Daftar Mahasiswa</h1>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID Mahasiswa</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
			<?php if (isset($mahasiswa) && count($mahasiswa) > 0): ?>
				<?php foreach ($mahasiswa as $mhs): ?>
					<tr>
						<td><?php echo $mhs->id; ?></td>
						<td><?php echo $mhs->nama; ?></td>
						<td><?php echo $mhs->nim; ?></td>
						<td><?php echo $mhs->alamat; ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="4" class="text-center">Tidak ada data mahasiswa.</td>
				</tr>
			<?php endif; ?>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
