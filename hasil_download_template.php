<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil <?php echo $item['nama'] ?></title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            text-align: left;
        }

        .table th,
        .table td {
            border: 1px solid #000000;
        }
    </style>
</head>
<body>
    <h1>Hasil Varietas <?php echo $item['nama'] ?></h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Varietas</th>
                <th>Rangking</th>
                <th>Nilai</th>
                <?php foreach ($kriteriaItems as $kriteriaItem) { ?>
                    <th><?php echo $kriteriaItem['nama'] ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasilItems as $index => $hasilItem) { ?>
                <?php $nilai = json_decode($hasilItem['nilai'], true); ?>
                <?php
                    $bobot = array_values($hasilItem['bobot']);
                ?>
                <tr>
                    <td><?php echo $index + 1 ?></td>
                    <td><?php echo $hasilItem['nama'] ?></td>
                    <td><?php echo $hasilItem['no'] ?></td>
                    <td><?php echo $nilai['nilai_akhir'] ?></td>
                    <?php foreach ($kriteriaItems as $kriteriaItem) { ?>
                        <?php $bobotKey = array_search($kriteriaItem['id'], array_column($bobot, 'kriteria_id')); ?>
                        <td><?php echo $bobotKey !== false ? $bobot[$bobotKey]['bobot'] : null ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>