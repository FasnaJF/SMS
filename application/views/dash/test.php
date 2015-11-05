<body>

<?php include_once("dash_topbar.php"); ?>
<script type="application/javascript" src=<?php echo base_url("js/md5.js"); ?>></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js">-->
<?php

$str = 'hello';


?>

<script>
var x = '<?php echo $str; ?>';
var mdjs = md5(x);


<?php $abc = '<script>document.write(mdjs)</script>'?>
</script>

<?php
$md5 = md5($str);

//echo $md5;
//
//echo '<br/>'.$abc;

if (strcmp($md5,$abc)){
    echo "hellooooooo";
}
else{
    echo "go and die";
}
?>



