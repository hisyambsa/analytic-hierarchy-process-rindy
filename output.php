<?php
include('header.php');

?>

<section class="content">
	<h3 class="ui header">Matriks Perbandingan Berpasangan</h3>
	<table class="ui collapsing celled blue table">
		<thead>
			<tr>
				<th>Kriteria</th>
				<?php
				for ($i = 0; $i <= ($n - 1); $i++) {
					echo "<th>" . getKriteriaNama($i) . "</th>";
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			for ($x = 0; $x <= ($n - 1); $x++) {
				echo "<tr>";
				echo "<td>" . getKriteriaNama($x) . "</td>";
				for ($y = 0; $y <= ($n - 1); $y++) {
					echo "<td>" . round($matrik[$x][$y], 2) . "</td>";
				}

				echo "</tr>";
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>Jumlah</th>
				<?php
				for ($i = 0; $i <= ($n - 1); $i++) {
					echo "<th>" . round($jmlmpb[$i], 2) . "</th>";
				}
				?>
			</tr>
		</tfoot>
	</table>


	<br>

	<h3 class="ui header">Matriks Nilai Kriteria</h3>
	<table class="ui celled red table">
		<thead>
			<tr>
				<th>Kriteria</th>
				<?php
				for ($i = 0; $i <= ($n - 1); $i++) {
					echo "<th>" . getKriteriaNama($i) . "</th>";
				}
				?>
				<th>Jumlah</th>
				<th>Rata-rata</th>
				<!-- <th>Eigen Value</th> -->
			</tr>
		</thead>
		<tbody>
			<?php
			$eigenValueTotal = 0;
			for ($x = 0; $x <= ($n - 1); $x++) {
				echo "<tr>";
				echo "<td>" . getKriteriaNama($x) . "</td>";
				for ($y = 0; $y <= ($n - 1); $y++) {
					echo "<td>" . round($matrikb[$x][$y], 2) . "</td>";
				}
				echo "<td>" . round($jmlmnk[$x], 2) . "</td>";
				echo "<td>" . round($pv[$x], 2) . "</td>";
				$eigenValueTotal += round(round($jmlmpb[$x], 2) * round($pv[$x], 2), 2);
				// echo "<td>" . round($jmlmpb[$x], 2) . '-' . round($jmlmpb[$x], 2) * round($pv[$x], 2) . "</td>";
				// echo "<td>1</td>";

				echo "</tr>";
			}
			?>

		</tbody>
		<tfoot>
			<tr>
				<th colspan="<?php echo ($n + 2) ?>">Jumlah</th>
				<th><?php echo (round($eigenValueTotal, 2)) ?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n + 2) ?>">n Kriteria</th>
				<th><?php echo (round($n, 2)) ?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n + 2) ?>">Lamda Max</th>
				<th><?php echo (round($jumlahRatio, 2) / $n) ?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n + 2) ?>">Consistency Index</th>
				<th><?php echo (round($consIndex, 2)) ?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n + 2) ?>">IR</th>
				<th><?php echo (round($nilaiIR, 2)) ?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n + 2) ?>">Consistency Ratio</th>
				<th><?php echo $consRatioPersen = (round(($consRatio * 100), 2)) ?> %</th>
			</tr>
		</tfoot>
	</table>

	<?php
	if ($consRatio > 1) {
	?>
		<div class="ui icon red message">
			<i class="close icon"></i>
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					Nilai Consistency Ratio melebihi 10% !!!
				</div>
				<p>Mohon input kembali tabel perbandingan...</p>
			</div>
		</div>

		<br>

		<a href='javascript:history.back()'>
			<button class="ui left labeled icon button">
				<i class="left arrow icon"></i>
				Kembali
			</button>
		</a>

	<?php
	} else {

	?>
		<br>

		<a href="bobot.php?c=1">
			<button class="ui right labeled icon button" style="float: right;">
				<i class="right arrow icon"></i>
				Lanjut
			</button>
		</a>

	<?php
	}
	echo "</section>";
	include('footer.php');
	?>