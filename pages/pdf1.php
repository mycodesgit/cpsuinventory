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
    font-weight: bold;
  }
</style>

<table>
  <thead>
    <tr>
        <td colspan="11" style="text-align: center; padding: 8px;">
            <h4>PHYSICAL, PLANT AND EQUIPMENT INVENTORY </h4>
        </td>
    </tr>
    <tr>
      <th>Property Number</th>
      <th>Qty.</th>
      <th>Description</th>
      <th>Specification</th>
      <th>Acquisition Date</th>
      <th>Unit</th>
      <th>Unit Value</th>
      <th>Classification</th>
      <th>End User</th>
      <th>Where about</th>
      <th>Remarks</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!isset($_SESSION['category_id'])){
          $category_id = "";
      }
      if(isset($_SESSION['category_id'])){
          $category_id = $_SESSION['category_id'];
      }
      
      if(!isset($_SESSION['acquisition_date'])){
          $acquisition_date = "";
      }
      if(isset($_SESSION['acquisition_date'])){
          $acquisition_date = $_SESSION['acquisition_date'];
      }

      if(!isset($_SESSION['where_about'])){
          $where_about = "";
      }
      if(isset($_SESSION['where_about'])){
          $where_about = $_SESSION['where_about'];
      }

      if(!isset($_SESSION['end_user'])){
          $end_user = "";
      }
      if(isset($_SESSION['end_user'])){
          $end_user = $_SESSION['end_user'];
      }
      if(!isset($_SESSION['category_id']) && !isset($_SESSION['acquisition_date']) && !isset($_SESSION['where_about']) && !isset($_SESSION['end_user'])){
          $query = $DB->prepare( "SELECT ppei.*, category.category_name AS category_name, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr FROM ppei INNER JOIN category ON ppei.category_id = category.id INNER JOIN classification ON classification.id = ppei.classification_id INNER JOIN offices ON offices.id = ppei.where_about" );
      }
      if(isset($_SESSION['category_id']) || isset($_SESSION['acquisition_date']) || isset($_SESSION['where_about']) || isset($_SESSION['end_user'])){
          $query = $DB->prepare( "SELECT ppei.*, category.category_name AS category_name, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr FROM ppei INNER JOIN category ON ppei.category_id = category.id INNER JOIN classification ON classification.id = ppei.classification_id INNER JOIN offices ON offices.id = ppei.where_about WHERE ppei.category_id LIKE '%$category_id%' AND ppei.acquisition_date LIKE '%$acquisition_date%' AND ppei.where_about LIKE '%$where_about%' AND ppei.end_user LIKE '%$end_user%'");
      }
      $query->execute();
      $result = $query->get_result();
      $sum_unit_value = 0; 
      if ($result->num_rows > 0) {
          while ($item = $result->fetch_object()) { 
              $sum_unit_value += $item->unit_value; 
    ?>
    <tr>
      <td><?php echo $item->property_no ?></td>
      <td><?php echo $item->qty ?></td>
      <td><?php echo $item->category_name." ", $item->description ?></td>
      <td><?php echo $item->specification ?></td>
      <td><?php $acq = $item->acquisition_date; print date("M d, Y", strtotime($acq)) ?></td>
      <td><?php echo $item->unit ?></td>
      <td><?php echo number_format($item->unit_value, 2) ?></td>
      <td><?php echo $item->class_name ?></td>
      <td><?php echo $item->end_user ?></td>
      <td><?php echo $item->office_abbr ?></td>
      <td><?php echo $item->remarks ?></td>
    </tr>
    <?php }
      } else {
    }
    ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="6" style="text-align: right;">Total:</td>
      <td><?php echo number_format($sum_unit_value, 2); ?></td>
      <td colspan="4"></td>
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
