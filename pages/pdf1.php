<?php 
// (A) LOAD MPDF
require "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 9,
    'default_font' => 'Times New Roman',
    'format' => 'Legal',
    'orientation' => 'L' // set orientation to landscape
]);

$id = 123; 
ob_start();
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    th, td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tfoot td {
        font-weight: ;
    }
</style>

<table>
    <thead>
        <tr>
            <td class="none" colspan="10" style="text-align: right; padding: 8px; font-style: italic; border-bottom: none;">
                <h4 style="font-weight: 0px;">Appendix 73</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10" style="text-align: center; padding: 8px; border-top: none; border-bottom: none;">
                <h3>REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT </h3><br>
                _______________________________________________<br>
                (Type of Property, Plant and Equipment)<br>
                <?php 
                    if(isset($_SESSION['date1']) && isset($_SESSION['date2'])){
                            $date1 = $_SESSION['date1'];
                            $date2 = $_SESSION['date2'];
                            $formattedDate1 = date("F d", strtotime($date1));
                            $formattedDate2 = date("F d, Y", strtotime($date2));
                            $formattedDate = "";
                    
                            if ($date1 == $date2) {
                                $formattedDate = $formattedDate2;
                            } elseif (date("m", strtotime($date1)) === date("m", strtotime($date2))) {
                                $formattedDate = date("F", strtotime($date1)) . " " . date("d", strtotime($date1)) . "-" . date("d", strtotime($date2)) . ", " . date("Y", strtotime($date1));
                            } else {
                                $formattedDate = $formattedDate1 . " - " . $formattedDate2;
                            }
                            echo "As at&emsp;".$formattedDate;
                     }
                ?>
                
            </td>
        </tr>
        <tr>
            <td colspan="10" style="text-align: left; border-top: none; border-bottom: none;">
                Found Cluster:_________________________________<br>
                For which&emsp;__(<span style="border-bottom: 1px solid black;">&emsp;<?php if(isset($_SESSION['end_user'])){ echo $_SESSION['end_user']; } ?>&emsp;</span>)__,__(__________________________________)__,__(__________________________________)&emsp;is accountable, having assumed such accountability on (___________________).
            </td>
        </tr>
        <tr>
            <th rowspan="2">ARTICLE</th>
            <th rowspan="2">DESCRIPTION</th>
            <th rowspan="2">PROPERTY<br>NUMBER</th>
            <th rowspan="2">UNIT OF <br> MEASURE</th>
            <th rowspan="2">UNIT VALUE</th>
            <th rowspan="2" width="170">QUANTITY PER<br>PROPERTY CARD</th>
            <th rowspan="2" width="170">QUANTITY PER<br>PHYSICAL COUNT</th>
            <th colspan="2">SHORTAGE/OVERAGE</th>
            <th rowspan="2">REMARKS</th>
        </tr>
        <tr>
            <th>Qunatity</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        if (!isset($_SESSION['end_user'])) {
            $end_user = "";
        }
        if (isset($_SESSION['end_user'])) {
            $end_user = $_SESSION['end_user'];
        }
        
        if (!isset($_SESSION['date1'])) {
            $date1 = "";
        }
        if (isset($_SESSION['date1'])) {
            $date1 = $_SESSION['date1'];
        }
        
        if (!isset($_SESSION['date2'])) {
            $date2 = "";
        }
        if (isset($_SESSION['date2'])) {
            $date2 = $_SESSION['date2'];
        }
        
        if (!isset($_SESSION['end_user']) && !isset($_SESSION['date1']) && !isset($_SESSION['date2'])) {
            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
            FROM ppei 
            INNER JOIN classification ON classification.id = ppei.classification_id 
            INNER JOIN offices ON offices.id = ppei.where_about 
            WHERE statdel = 1 
            ORDER BY (remarks = 'Good Order and Condition') DESC, remarks ASC");
            $query->execute();
        }
        if (isset($_SESSION['end_user']) && isset($_SESSION['date1']) && isset($_SESSION['date2'])) {
            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
            FROM ppei 
            INNER JOIN classification ON classification.id = ppei.classification_id 
            INNER JOIN offices ON offices.id = ppei.where_about 
            WHERE statdel = 1 AND ppei.end_user = ?
            AND ppei.acquisition_date BETWEEN ? AND ?");
            $query->bind_param('sss',$end_user, $date1, $date2);
            $query->execute();
        }
        if(!isset($_SESSION['end_user']) && isset($_SESSION['date1']) && isset($_SESSION['date2'])){
            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
            FROM ppei 
            INNER JOIN classification ON classification.id = ppei.classification_id 
            INNER                     JOIN offices ON offices.id = ppei.where_about 
            WHERE statdel = 1  
            AND ppei.acquisition_date BETWEEN ? AND ?");
            $query->bind_param('ss',$date1, $date2);
            $query->execute();
        }
        if(isset($_SESSION['end_user']) && !isset($_SESSION['date1']) && !isset($_SESSION['date2'])){
            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
            FROM ppei 
            INNER JOIN classification ON classification.id = ppei.classification_id 
            INNER                     JOIN offices ON offices.id = ppei.where_about 
            WHERE statdel = 1  
            AND ppei.end_user = ?");
            $query->bind_param('s', $end_user);
            $query->execute();
        }
        
        $query->execute();
        $result = $query->get_result();
        $sum_unit_value = 0;
        if ($result->num_rows > 0) {
        while ($item = $result->fetch_object()) {
        $sum_unit_value += $item->unit_value;
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $item->description ?></td>
            <td><?php echo $item->property_no ?></td>
            <td><?php echo $item->unit ?></td>
            <td><?php echo number_format($item->unit_value, 2) ?></td>
            <td></td>
            <td></td>
            <td><?php echo $item->qty ?></td>
            <td><?php echo number_format($item->unit_value * $item->qty, 2) ?></td>
            <td><?php echo $item->remarks ?></td>
        </tr>
        <?php }
        } else {
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="border-right: none; border-bottom: none; text-align: left;"><strong>Certified Correct by:</strong></td>
            <td colspan="4" style="border-right: none; border-left: none; border-bottom: none; text-align: left;"><strong>Approved by:</strong></td>
            <td colspan="3" style="border-left: none; border-bottom: none; text-align: left;"><strong>Verified by:</strong></td>
        </tr>
        <tr>
            <td colspan="3" style="border-right: none; border-top: none; text-align: center;">____________________________________<br>Signature over Printed Name of<br>Inventory Committee Chair and<br>Members</td>
            <td colspan="4" style="border-right: none; border-left: none; border-top: none; text-align: center;">___________________________________________________<br>Signature over Printed Name of Head of <br>Agency/Entity or Authorized Representative</td>
            <td colspan="3" style="border-left: none; border-top: none; text-align: center;">___________________________________________<br>Signature over Printed Name of COA<br>Representative</td>
        </tr>
    </tfoot>
</table>

<?php 
$table_html = ob_get_clean();

// (D) THE HTML
$html = $table_html;

// (E) WRITE HTML TO PDF
$mpdf->WriteHTML($html);

// (F) OUTPUT PDF
$mpdf->Output();
?>
