<?php

include('config.php');
include('fungsi.php');


if (isset($_POST['submit'])) {
	$jenis = $_POST['jenis'];

	// jumlah kriteria
	if ($jenis == 'kriteria') {
		$n		= getJumlahKriteria();
	} else {
		$n		= getJumlahAlternatif();
	}

	// memetakan nilai ke dalam bentuk matrik
	// x = baris
	// y = kolom
	$matrik = array();
	$urut 	= 0;

	for ($x = 0; $x <= ($n - 2); $x++) {
		for ($y = ($x + 1); $y <= ($n - 1); $y++) {
			$urut++;
			$pilih	= "pilih" . $urut;
			$bobot 	= "bobot" . $urut;
			if ($_POST[$pilih] == 1) {
				$matrik[$x][$y] = $_POST[$bobot];
				$matrik[$y][$x] = 1 / $_POST[$bobot];
			} else {
				$matrik[$x][$y] = 1 / $_POST[$bobot];
				$matrik[$y][$x] = $_POST[$bobot];
			}


			if ($jenis == 'kriteria') {
				inputDataPerbandinganKriteria($x, $y, round($matrik[$x][$y], 2));
			} else {
				inputDataPerbandinganAlternatif($x, $y, ($jenis - 1), round($matrik[$x][$y], 2));
			}
		}
	}

	// diagonal --> bernilai 1
	for ($i = 0; $i <= ($n - 1); $i++) {
		$matrik[$i][$i] = 1;
	}

	// inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i = 0; $i <= ($n - 1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}

	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x = 0; $x <= ($n - 1); $x++) {
		for ($y = 0; $y <= ($n - 1); $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;
			// $jmlmpb[$y] += round(a$value, 2);
		}
	}


	// menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrikb merupakan matrik yang telah dinormalisasi
	for ($x = 0; $x <= ($n - 1); $x++) {
		for ($y = 0; $y <= ($n - 1); $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += round($value, 2);
		}

		// nilai priority vektor
		$pv[$x]	 = $jmlmnk[$x] / $n;

		// memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
		if ($jenis == 'kriteria') {
			$id_kriteria = getKriteriaID($x);
			inputKriteriaPV($id_kriteria, $pv[$x]);
		} else {
			$id_kriteria	= getKriteriaID($jenis - 1);
			$id_alternatif	= getAlternatifID($x);
			inputAlternatifPV($id_alternatif, $id_kriteria, $pv[$x]);
		}
	}

	// cek konsistensi
	$jumlahRatio = getEigenVector($jmlmpb, $jmlmnk, $n);
	// $jumlahRatio = 5.98;
	$consIndex   = getConsIndex($jmlmpb, $jmlmnk, $n, $matrikb, $jmlmnk, $pv);
	$eigenvektor = getEigenVector($jmlmpb, $jmlmnk, $n); //Principe Eigen Vector (λ maks)); //Principe Eigen Vector (λ maks)
	$nilaiIR = getNilaiIR($n);
	$consRatio   = getConsRatio($jmlmpb, $jmlmnk, $n, $matrikb, $jmlmnk, $pv);

	if ($jenis == 'kriteria') {
		include('output.php');
	} else {
		include('bobot_hasil.php');
	}
}
