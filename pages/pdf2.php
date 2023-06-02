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
    border: 1px solid #ddd;
  }
  th, td {
    padding: 8px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 10px;
  }
  th {
    background-color: #f2f2f2;
  }
  .none{
    border: none;
  }
  tfoot{
    border: 1px solid #ddd;
  }
</style>

<table>
  <thead>
    <tr>
        <td class="none" colspan="21" style="text-align: right; padding: 8px; font-style: italic;">
            <h3>Appendix 74</h3>
        </td>
    </tr>
    <tr>
        <td class="none" colspan="21" style="text-align: center; padding: 8px;">
            <h3>INVENTORY AND INSPECTION REPORT OF UNSERVICEABLE PROPERTY</h3><br>
            As at _____________________________
        </td>
    </tr>
    <tr>
        <td class="none" colspan="9" style="text-align: left;">
            Entity Name:_____________________________
        </td>
        <td class="none" colspan="9" style="text-align: right;">
            Fund Cluster:_____________________________
        </td>
    </tr>
    <tr>
      <td class="none" colspan="4" style="font-style: italic; border-top: 1px;">________________________________<br>(Name of Accountable Officer)</td>
      <td class="none" colspan="4" style="font-style: italic; border-top: 1px;">________________________________<br>(Designation)</td>
      <td class="none" colspan="4" style="font-style: italic; border-top: 1px;">________________________________<br>(Station)</td>
    </tr>
    <tr>
      <th colspan="10">INVENTORY</th>
      <th colspan="11">INSPECTION and DISPOSAL</th>
    </tr>

  </thead>
  <tbody>
    <tr>
      <td rowspan="2">Date<br> Acquired</td>
      <td rowspan="2">Particulars /<br> Articles</td>
      <td rowspan="2">Serial Number</td>
      <td rowspan="2">Propert No.</td>
      <td rowspan="2">Qty</td>
      <td rowspan="2">Unit Cost</td>
      <td rowspan="2">Total Cost</td>
      <td rowspan="2">Accumulated<br>Depreciation</td>
      <td rowspan="2">Accumulated<br>Impairment<br>losses</td>
      <td rowspan="2">Carrying<br>Amount</td>
      <td rowspan="2">Remarks</td>
      <td colspan="5">DISPOSAL</td>
      <td rowspan="2">Appraised <br> Value</td>
      <td colspan="5">RECORD OF SALES</td>
    </tr>
    <tr>
      <td>Sale</td>
      <td>Transfer</td>
      <td>Destruction</td>
      <td>Pthers<br>(Specify)</td>
      <td>Total</td>
      
      <td>OR No.</td>
      <td>Amount</td>
      <td>End USer</td>
      <td>Status</td>
    </tr>
    <tr>
      <td>(1)</td>
      <td>(2)</td>
      <td>(3)</td>
      <td>(4)</td>
      <td>(5)</td>
      <td>(6)</td>
      <td>(7)</td>
      <td>(8)</td>
      <td>(9)</td>
      <td>(10)</td>
      <td>(11)</td>
      <td>(12)</td>
      <td>(13)</td>
      <td>(14)</td>
      <td>(15)</td>
      <td>(16)</td>
      <td>(17)</td>
      <td>(18)</td>
      <td>(19)</td>
      <td>(20)</td>
      <td>(21)</td>
    </tr>
    <?php
                  
                  if(!isset($_SESSION['where_about1'])){
                      $where_about = "";
                  }
                  if(isset($_SESSION['where_about1'])){
                      $where_about = $_SESSION['where_about1'];
                  }

                  if(!isset($_SESSION['end_user1'])){
                      $end_user = "";
                  }
                  if(isset($_SESSION['end_user1'])){
                      $end_user = $_SESSION['end_user1'];
                      
                  }

                  if(!isset($_SESSION['date11'])){
                      $date1 = "";
                  }
                  if(isset($_SESSION['date11'])){
                      $date1 = $_SESSION['date11'];
                  }

                  if(!isset($_SESSION['date22'])){
                      $date2 = "";
                  }
                  if(isset($_SESSION['date22'])){
                      $date2 = $_SESSION['date22'];
                  }
                   
              if(!isset($_SESSION['where_about']) && !isset($_SESSION['end_user']) && !isset($_SESSION['date1']) && !isset($_SESSION['date2'])){
                      $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                      FROM ppei 
                      INNER JOIN classification ON classification.id = ppei.classification_id 
                      INNER JOIN offices ON offices.id = ppei.where_about 
                      WHERE statdel = 1 AND remarks!='Good'");
                     
              }
              else{
                  if(!isset($_SESSION['date11']) && !isset($_SESSION['date22'])){
                      if (isset($_SESSION['where_about1']) || isset($_SESSION['end_user1'])) {
                          $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                          FROM ppei 
                          INNER JOIN classification ON classification.id = ppei.classification_id 
                          INNER JOIN offices ON offices.id = ppei.where_about 
                          WHERE statdel = 1 AND remarks!='Good'
                          AND ppei.where_about LIKE ? 
                          OR ppei.end_user LIKE ?");
                          
                          $query->bind_param('ss', $where_about, $end_user);
                         
                      }
                      if (!isset($_SESSION['where_about1']) && !isset($_SESSION['end_user1'])) {
                          $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                          FROM ppei 
                          INNER JOIN classification ON classification.id = ppei.classification_id 
                          INNER JOIN offices ON offices.id = ppei.where_about 
                          WHERE statdel = 1 AND remarks!='Good'");
                         
                      }
                  }

                  if (isset($_SESSION['date11']) && isset($_SESSION['date22'])) {
                      if (isset($_SESSION['where_about1']) || isset($_SESSION['end_user1'])) {
                          $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                          FROM ppei 
                          INNER JOIN classification ON classification.id = ppei.classification_id 
                          INNER JOIN offices ON offices.id = ppei.where_about 
                          WHERE statdel = 1 AND remarks!='Good' 
                          AND ppei.where_about LIKE ? 
                          OR ppei.end_user LIKE ? 
                          AND ppei.created_at BETWEEN ? AND ?");
  
                          $where_about = '%' . $where_about . '%';
                          $end_user = '%' . $end_user . '%';
                          
                          $query->bind_param('ssss', $where_about, $end_user, $date1, $date2);
                         
                      }
                      if (!isset($_SESSION['where_about1']) && !isset($_SESSION['end_user1'])) {
                          $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                          FROM ppei 
                          INNER JOIN classification ON classification.id = ppei.classification_id 
                          INNER JOIN offices ON offices.id = ppei.where_about 
                          WHERE statdel = 1 AND remarks!='Good' 
                          AND ppei.created_at BETWEEN ? AND ?");
  
                          $end_user = '%' . $end_user . '%';
                          
                          $query->bind_param('ss', $date1, $date2);
                         
                      }
                  }
              }
      
      $query->execute();
      $result = $query->get_result();
      $sum_unit_value = 0; 
      if ($result->num_rows > 0) {
          while ($item = $result->fetch_object()) { 
              $sum_unit_value += $item->unit_value; 
    ?>
    <tr>
      <td><?php $acq = $item->acquisition_date; print date("M d, Y", strtotime($acq)) ?></td>
      <td><?php echo $item->description ?></td>
      <td><?php echo $item->serial_no ?></td>
      <td><?php echo $item->property_no ?> <?php echo $item->specification ?></td>
      <td><?php echo $item->qty ?></td>
      <td><?php echo number_format($item->unit_value, 2) ?></td>
      <td><?php echo number_format($item->unit_value, 2) ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo $item->remarks ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo $item->end_user ?></td>
      <td><?php echo $item->remarks ?></td>
    </tr>
    <?php }
      } else {
    }
    ?>
  </tbody>
  <tfoot>
    <tr>
        <td class="none" style="text-align: left;" colspan="9">I HEREBY request inspection and disposition, pursuant to Section 79 of PD 1445, of the property and inumerated above.</td>
        <td class="none" colspan="5">I CERTIFY that I have inspected each and every article enumerated in this report , and that the disposition made therefor was, in my judgement, the best for the public interest.</td>
        <td class="none" style="text-align: left;" colspan="4">I CERTIFY that I have witnessed the disposition of the articles enumerated on this report this ____ day of _________, </td>
    </tr>
    <tr>
        <td class="none">Requested by:</td>
        <td class="none" colspan="3"></td>
        <td class="none" colspan="2">Approved by:</td>
        <td class="none" colspan="6"></td>
    </tr>
    <tr>
        <td class="none" colspan="4">____________________________________________________<br>(Signature over Printed Name of Accountable Officer)</td>
        <td class="none" colspan="4">____________________________________________________<br>(Signature over Printed Name of Authorize Official)</td>
        <td class="none" colspan="2"></td>

        <td class="none" colspan="5" style="text-align: center;" >____________________________________________________<br>(Signature over Printed Name of Inspection Officer)</td>
        <td class="none" colspan="4" style="text-align: center;" >____________________________________________________<br>(Signature over Printed Name of Witness)</td>
        
    </tr>
    <tr>
        <td class="none" colspan="4">________________________________________________<br>(Designation of Accountable Officer)</td>
        <td class="none" colspan="4">________________________________________________<br>(Designation of Authorized Official)</td>
        <td class="none" colspan="6"></td>
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
