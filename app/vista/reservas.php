<?php ob_start() ?>
<h1>Reservas de <?php echo $_SESSION['user'] ?></h1>
<table>
    <tr>
        <td class="tableIndex">Aula</td>
        <td class="tableIndex">Fecha</td>
        <td class="tableIndex">Hora</td>
    </tr>
<?php 
for($a=0; $a<count($params); $a++){
    echo '<tr>';
    echo '<td>'.$params['IdAula'][$a].'</td>';
    echo '<td>'.$params['Fecha'][$a].'</td>';
    echo '<td>'.$params['Hora'][$a].'</td>';
    echo '</tr>';
}
?>
</table>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>