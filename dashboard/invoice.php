
<?php

include("config.php");

$id = $_GET['id'];
$month = $_GET['id'];

$sql = "SELECT students.id, students.name, students.class, students.father, students.dob, students.phone, students.address, students.aadhar, class.monthly_fee, class.class_name FROM students JOIN class ON students.class = class.class_name WHERE students.id='$id'";

$result = mysqli_query($conn, $sql);


?>




<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="../includes/invoice.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="../includes/script.js"></script>
	</head>
	<body>
		<header>
			<h1>Fee Receipt</h1>
			<address><?php
			while($row = mysqli_fetch_assoc($result)){
          echo "<p>".$row['name']."</p><p>Class: ".$row['class_name']."<p>".$row['address']."<br><p>+91 ".$row['phone']."</p>";
        };
        ?>
			</address>
			<span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address >
				<p>Some Company<br>c/o Some Guy</p>
			</address>
			<table class="meta">
				<tr>
					<th><span >Invoice #</span></th>
					<td><span ></span></td>
				</tr>
				<tr>
					<th><span >Date</span></th>
					<td><span >January 1, 2012</span></td>
				</tr>
				<tr>
					<th><span >Amount Due</span></th>
					<td><span id="prefix" >$</span><span>600.00</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span >Item</span></th>
						<th><span >Description</span></th>
						<th><span >Rate</span></th>
						<th><span >Quantity</span></th>
						<th><span >Price</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a class="cut">-</a><span >Front End Consultation</span></td>
						<td><span >Experience Review</span></td>
						<td><span data-prefix>$</span><span >150.00</span></td>
						<td><span >4</span></td>
						<td><span data-prefix>$</span><span>600.00</span></td>
					</tr>
				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
				<tr>
					<th><span >Total</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
				<tr>
					<th><span >Amount Paid</span></th>
					<td><span data-prefix>$</span><span >0.00</span></td>
				</tr>
				<tr>
					<th><span >Balance Due</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span >Additional Notes</span></h1>
			<div >
				<p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
			</div>
		</aside>
	</body>
</html>