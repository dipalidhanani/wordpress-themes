<?php
/**
 * Template Name: TRAVEL INSURANCE ACCEPTANCE
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 get_header();
 ?>
 <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	 jQuery("#frm_pdf").validate();
  });
</script>
<script type="text/javascript">
function evalGroup()
{
var group = document.frm_pdf.chk;
for (var i=0; i<group.length; i++) {
if (group[i].checked)
break;
}
if (i==group.length){
document.getElementById('chk_box').style.display='';
}

if(i!=group.length){
	document.getElementById('chk_box').style.display='none';
	//document.getElementById('chk_box').style.color='#009933';	
}
}
</script>

 <?php
 

 
if($_POST["pdf_insert"]=='1') {
$html='
<table style="border: 1px solid;" width="700" border="0" cellspacing="10" cellpadding="10">
<tbody>
<tr>
<td>
<table width="700" cellspacing="0" cellpadding="5">
<tbody>
<tr>
<td colspan="2">
<h1>TRAVEL INSURANCE ACCEPTANCE</h1>
</td>
</tr>
<tr>
<td colspan="2">Dear Traveler:</td>
</tr>
<tr>
<td colspan="2">Your upcoming trip is a significant investment, which involves risks.</td>
</tr>
<tr>
<td colspan="2">For this reason, Proud African Safaris strongly urges all its clients to purchase a comprehensive travel insurance plan valid for the entire duration of their trip. This insurance should cover you for events such as trip cancellation, delay or interruption, lost or delayed baggage, emergency accident, illness and evacuation, 24-hour medical assistance, traveler&#39;s assistance, and emergency cash transfer.</td>
</tr>
<tr>
<td colspan="2">For coverage, we suggest Travel Guard Insurance. The total premium will be based on each traveler&#39;s age and total per person trip price, including airfares.</td>
</tr>
<tr>
<td colspan="2">Please visit the Travel Guard website online at<span class="color"><a href="http://www.travelguard.com/" target="_blank"> http://www.travelguard.com/.</a></span></td>
</tr>
<tr>
<td colspan="2"><span class="color">Please note that you must return this completed form to Proud African Safaris before your trip departure.</span> A completed Travel Insurance Acceptance Form is a condition of travel.
Please be aware that many insurance plans provide extra coverage when the travel insurance is purchased within<span class="color"> 15 days</span> of making the initial trip payment. Please read the Travel Guard brochure / application for a complete description of the travel insurance benefits and assistance services.</td>
</tr>
<tr>
<td colspan="2">
<h1>The following information was completed by and confirmed by the traveler at the time of form submission. :</h1>
</td>
</tr>';
if($_REQUEST['chk1'] == '1'){
$html.='<tr>
<td colspan="2">I have read the brochure / application and have purchased a Travel Guard Comprehensive Tour Protection plan. I have included the policy number below so you may confirm my/our coverage.</td>
</tr>';
}
if($_REQUEST['chk2'] == '2'){
$html.='<tr>
<td colspan="2">I have decided to purchase a comprehensive tour protection plan from another insurance company and have included details so you may confirm my/our coverage.</td>
</tr>';
}
if($_REQUEST['chk3'] == '3'){
$html.='<tr>
<td colspan="2">Comprehensive travel insurance has been explained and recommended to me relative to my forthcoming trip; however, I have declined to purchase such insurance. I, the undersigned, accept full responsibility for, and will not hold Proud African Safaris responsible, for any loss or expense incurred which would have been covered by the recommended comprehensive travel insurance.</td>
</tr>';
}

$html.='<tr>
<td width="50%">Type Signature : '.$_REQUEST['participant_signature'].'</td>
<td width="50%">Date : '.$_REQUEST['date'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
<tr>
<td width="50%">Type Name To Confirm : '.$_REQUEST['print_name'].'</td>
<td width="50%">Trip Dates : '.$_REQUEST['trip_dates'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
<tr>
<td width="50%">Insurance Company : '.$_REQUEST['insurance_company'].'</td>
<td width="50%">Policy Number : '.$_REQUEST['policy_number'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
<tr>
<td width="50%" colspan="2">Insurance company contact telephone (if not using Travel Guard): '.$_REQUEST['insurance_company_contact'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>';

if($_REQUEST['agree1'] == '1'){
$html.='<tr>
<td colspan="2">I Agree : By clicking in the box marked "I agree," you consent to the use of electronic signatures in connection with your Proud African Safari Booking. You understand that your electronic signature is legally binding, just as if you had signed a paper document.</td>
</tr>';
}
$html.='<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2" align="center"> 12 Greystone Road, Marblehead, MA 01945 · Toll free (888)-629-6755 · Fax 781-631-4711</td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
';
include("mpdf/mpdf.php");

//$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);
$mpdf=new mPDF('c','A4','','',10,10,10,10,0,0);
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no

$mpdf->WriteHTML($html);
$filename="pdf_form.pdf";
$content = $mpdf->Output('', 'S');
$content = chunk_split(base64_encode($content));
$mpdf->Output($filename);


require("libMail/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsMail();


 //$mail->AddAddress("carrie@mayodesigns.com");
$mail->AddAddress("nandi@proudafricansafaris.com");
$mail->AddAddress("steve@proudafricansafaris.com");




$mail->Subject = "PDF Attachment";
$mail->Body = "Please find PDF Attachment.";
$mail->SetFrom("info@proudafricansafaris.com");    
$mail->AddReplyTo("info@proudafricansafaris.com");
$mail->AddAttachment($filename) ;
if(!$mail->Send())
{
   echo "Error sending: " . $mail->ErrorInfo;;
}
else
{
   echo "<span style='text-align: center;display: block; color: green; font-size: 20px;'> Thank you for your submission.</span>";
}



}else{
?>
<div class="main"><form id="frm_pdf" method="post" name="frm_pdf" >
<input type="hidden" name="pdf_insert" value="1" />
<input type="hidden" name="pdf_insert" value="1" />

<table width="100%" border="0" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="2" style="text-align: center;"><img src="http://proudafricansafaris.com/wp-content/uploads/2013/06/img.png" alt="" width="300" height="145" /></td>
</tr>
<tr>
<td colspan="2" style="text-align: center;"><strong><h1>TRAVEL INSURANCE ACCEPTANCE</h1></strong>
</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2"></td>
</tr>
</tbody>
</table>


<table style="padding: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td>Dear Traveler:</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>Your upcoming trip is a significant investment, which involves risks.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>For this reason, Proud African Safaris strongly urges all its clients to purchase a comprehensive travel insurance plan valid for the entire duration of their trip. This insurance should cover you for events such as trip cancellation, delay or interruption, lost or delayed baggage, emergency accident, illness and evacuation, 24-hour medical assistance, traveler&#39;s assistance, and emergency cash transfer.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>For coverage, we suggest Travel Guard Insurance. The total premium will be based on each traveler&#39;s age and total per person trip price, including airfares.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>Please visit the Travel Guard website online at<span class="color"> <a href="http://www.travelguard.com/" target="_blank"> http://www.travelguard.com/.</a></span></td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td><span class="color">Please note that you must return this completed form to Proud African Safaris before your trip departure.</span> A completed Travel Insurance Acceptance Form is a condition of travel.
Please be aware that many insurance plans provide extra coverage when the travel insurance is purchased within<span class="color"> 15 days</span> of making the initial trip payment. Please read the Travel Guard brochure / application for a complete description of the travel insurance benefits and assistance services.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>
<h1>Please check one of the following:</h1>
</td>
</tr>
<tr>
<td><input type="checkbox" name="chk1"  id="chk" value="1" />I have read the brochure / application and have purchased a Travel Guard Comprehensive Tour Protection plan. I have included the policy number below so you may confirm my/our coverage.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td><input type="checkbox" name="chk2"  id="chk" value="2" />I have decided to purchase a comprehensive tour protection plan from another insurance company and have included details so you may confirm my/our coverage.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td><input type="checkbox" name="chk3"  id="chk" value="3"/>Comprehensive travel insurance has been explained and recommended to me relative to my forthcoming trip; however, I have declined to purchase such insurance. I, the undersigned, accept full responsibility for, and will not hold Proud African Safaris responsible, for any loss or expense incurred which would have been covered by the recommended comprehensive travel insurance.</td>
</tr>
<tr><td id="chk_box" style="color:#F00;display:none; font-size:13px; ">  Please check one of above checkbox </td></tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="25%">Type Signature : </td>
<td width="25%"><div class="er"><input id="participant_signature" type="text" name="participant_signature" class="required"  /></div></td>
<td width="15%">Date : </td>
<td width="35%"><div class="er"><input id="date" type="text" name="date" class="required" /></div></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
<tr>
<td>Type Name To Confirm :  </td>
<td width="25%"><div class="er"><input id="print_name" type="text" name="print_name" class="required"/></div></td>
<td width="25%">Trip Dates : </td>
<td width="25%"><div class="er"><input id="trip_dates" type="text" name="trip_dates" class="required" /></div></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>

<tr>
<td width="25%">Insurance Company : </td>
<td width="25%"><div class="er"><input id="insurance_company" type="text" name="insurance_company" class="required" /></div></td>
<td width="25%">Policy Number : </td>
<td width="25%"><div class="er"><input id="policy_number" type="text" name="policy_number" class="required"/></div></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"  width="60%">Insurance company contact telephone (if not using Travel Guard):</td>
<td width="20%"><div class="er"> <input id="insurance_company_contact" type="text" name="insurance_company_contact" class="required" /></div></td>
<td width="20%">&nbsp;</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
<tr>
<td colspan="4">
<div class="er-radio" ><input id="date2" type="radio" name="agree1" value="1"  class="required"/></div><div style="overflow:hidden">I Agree : By clicking in the box marked "I agree," you consent to the use of electronic signatures in connection with your Proud African Safari Booking. You understand that your electronic signature is legally binding, just as if you had signed a paper document. </div>
</td>

</tr>

<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
<tr>
<td colspan="4"  style="text-align: center;" align="center">
<input id="submit" style="font-size: 21px; height: 40px; width: 132px;" type="submit" name="submit" value="Submit" onclick="evalGroup()"/>
</td>
</tr>
</tbody>
</table>
</form></div>
<?php } 
get_footer();
?>
