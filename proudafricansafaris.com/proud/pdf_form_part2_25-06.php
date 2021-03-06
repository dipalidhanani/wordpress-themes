<?php
/**
 * Template Name: PDF2 Template
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

 <?php
 

 
if($_POST["pdf_insert"]=='1' && $_POST["pdf_genrate"]!='2') {
$html='
<table style="border: 1px solid;" width="700" border="0" cellspacing="0" cellpadding="5">
<tr><td colspan="2" align="center" style="padding:5px;"><img src="http://proudafricansafaris.com/wp-content/uploads/2013/06/img.png" height="145" width="300" border="0" /></td></tr>
<tr>
    <td colspan="2" align="center"><strong><h1>Reservations Booking Form</h1></strong></td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #444444;"></td>
  </tr>
  <tr><td colspan="2">Please read the attached Booking Terms and Conditions carefully before signing. All guests must sign and complete this form and return it to us with a $1,000.00per person non-refundable deposit to have a confirmed reservation.Privacy: All information is used solely by Proud African Safaris and its contracted tour operators / airlines in planning your tour.
</td></tr>
  <tr>
    <td colspan="2"><strong><u>Passport Details (Traveler #1)</u></strong></td>
  </tr>
  <tr>
    <td width="50%" style="border-bottom:1px solid #444444;">Full Name<br />(As appears in passport) : '.$_REQUEST['passport_full_name'].'
     </td>
    <td width="50%" style="border-bottom:1px solid #444444;">Shirt Size : '.$_REQUEST['passport_shirt_size'].'</td>
  </tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Passport Number : '.$_REQUEST['passport_number'].'</td>
<td style="border-bottom: 1px solid #444444;">Passport Nationality : '.$_REQUEST['passport_nationality'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Issue Date : '.$_REQUEST['passport_issue_date'].'</td>
<td style="border-bottom: 1px solid #444444;">Expiration Date : '.$_REQUEST['passport_expiration_date'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Place of issue : '.$_REQUEST['passport_place_of_issue'].'</td>
<td style="border-bottom: 1px solid #444444;">Sex : '.$_REQUEST['passport_shirt_type'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Date of birth : '.$_REQUEST['passport_date_of_birth'].'</td>
<td></td>
</tr>
<tr>
<td colspan="2"><strong><span style="text-decoration: underline;">Passport Details (Traveler #2)</span></strong></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" width="50%">Full Name
(As appears in passport) : '.$_REQUEST['passport_full_name2'].'</td>
<td style="border-bottom: 1px solid #444444;" width="50%">Shirt Size : '.$_REQUEST['passport_shirt_size2'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Passport Number : '.$_REQUEST['passport_number2'].'</td>
<td style="border-bottom: 1px solid #444444;">Passport Nationality : '.$_REQUEST['passport_nationality2'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Issue Date : '.$_REQUEST['passport_issue_date2'].'</td>
<td style="border-bottom: 1px solid #444444;">Expiration Date : '.$_REQUEST['passport_expiration_date2'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Place of issue : '.$_REQUEST['passport_place_of_issue2'].'</td>
<td style="border-bottom: 1px solid #444444;">Sex : '.$_REQUEST['passport_shirt_type2'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2">Date of birth : '.$_REQUEST['passport_date_of_birth2'].'</td>
</tr>
<tr>
<td colspan="2"><strong><span style="text-decoration: underline;">Personal Details</span></strong></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2">Street (As appears in passport) : '.$_REQUEST['street'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2">City State Zip : '.$_REQUEST['city_state_zip'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Telephone(Home) : '.$_REQUEST['telephone_home'].'</td>
<td style="border-bottom: 1px solid #444444;">(Work) : '.$_REQUEST['telephone_work'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Fax : '.$_REQUEST['fax'].'</td>
<td style="border-bottom: 1px solid #444444;">Email : '.$_REQUEST['email'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;">Physical Condition : '.$_REQUEST['physical_condition'].'</td>
<td style="border-bottom: 1px solid #444444;">Dietary Requirement : '.$_REQUEST['dietary_requirement'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2">Health Concerns : '.$_REQUEST['health_concerns'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2">Emergency Contact Name &amp; Telephone : '.$_REQUEST['emergency_contact_name'].'</td>
</tr>
</tbody>
</table>
<div style="page-break-before: always;"></div>
<table style="border: 1px solid;" width="700" border="0" cellspacing="10" cellpadding="10">
<tbody>
<tr>
<td>
<table width="700" border="0" cellspacing="0" cellpadding="5">
<tbody>
<tr>
<td colspan="2"><strong>BOOKING TERMS AND CONDITIONS
</strong></td>
</tr>
<tr>
<td colspan="2">Proud African Safaris is a trading name of Proud African Safaris LLC, a Limited Liability Corporation registered in the Commonwealth of Massachusetts. The following terms as used in these Booking Terms and Conditions shall be considered synonymous: safari,tour, and trip, all of which refer to the travel arrangements being booked with Proud African Safaris. Additionally, the following terms:client,guest,participant, member, passenger and traveler all refer to you, as the traveler. Booking Terms and Conditions Placement of an order with Proud African Safaris is taken as acceptance of the following terms and conditions.</td>
</tr>
<tr>
<td colspan="2"><strong>1. Reservations and Payments - </strong>Payment of a non-refundable deposit in the amount of $1,000.00 per person along with a completed and signed Reservation Booking Form and Travel Insurance Acceptance Form are required in order to confirm your reservation.All payments are to be done by wire transfer or check overnight to the office in Marblehead, Massachusetts. Proud African Safaris will also accept Visa or Mastercard for those individuals wishing to pay for their deposits and safaris with credit cards, however, a 3.31% service charge will then be added to the total cost of the safari.Upon receipt of deposit and reservation booking form, we will, subject to availability, reserve your place on your selected safari. In the event that any accommodation is not available we will substitute a comparable property or adjust the itinerary if necessary without compromising the integrity of the overall safari experience. The balance of the safari price is due in-full not later than 90 days prior to departure. All prices are quoted in U.S. dollars and must be paid in U.S. dollars.</td>
</tr>
<tr>
<td colspan="2"><strong>2. Cancellation and Refund Policy: </strong>Cancellations are only effective upon our receipt of written notification, signed by the client. If cancellation is made prior to 90 days before departure, your $1,000.00 per person deposit is forfeited but any additional payments made prior to the 90 days before departure will be refunded in-full. If your cancellation is made after the due date for full payment of your trip fare, payment cannot be refunded by Proud African Safaris. See below:
More than 90 days notice prior to departure date-Deposit forfeited, subsequent payments refunded
89-0 days notice prior to departure date–100% lost Should you fail to join a tour or join it after departure or leave it prior to its completion, no tour fare refund will be made. Some airfare may be non refundable. There will be no refunds from Proud African Safaris for any unused portions of the tour. The above policy applies to all travel arrangements made via Proud African Safaris.</td>
</tr>
<tr>
<td colspan="2"><strong>3. Insurance - </strong> It is a condition of booking that the sole responsibility lies with the guest to ensure that they carry the correct comprehensive travel and medical insurance to cover themselves, as well as any dependants and traveling companions for the duration of their tour to Africa. This insurance should include coverage in respect of, but not limited to, the following eventualities: cancellation or curtailment of the safari, emergency evacuation expenses, medical expenses, repatriation expenses, damage, theft or loss of personal baggage, money and goods. Proud African Safaris will take no responsibility for any costs for losses incurred or suffered by the guest, or guest’s dependants or traveling companions, with regards to, but not limited to, any of the above mentioned eventualities. Guests will be charged directly by the relevant service providers for any emergency services they may require, and may find themselves in a position unable to access such services should they not be carrying the relevant insurance coverage. A Travel Insurance Acceptance Form must be completed and returned to Proud African Safaris as a condition of travel.</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="page-break-before: always;"></div>
<table style="border: 1px solid;" width="700" border="0" cellspacing="10" cellpadding="10">
<tbody>
<tr>
<td>
<table width="700" cellspacing="0" cellpadding="5">
<tbody>
<tr>
<td><strong>4. Medical and Health -</strong>Participation on a safari or tour to East Africa requires that you be in generally good health. All guests must understand that while a high level of fitness is not required, a measure of physical activity is involved in all African safaris and tours. It is essential that persons with any medical problems and/or related dietary restrictions make them known to us well before departure. Anti-malaria precautions should be taken, and these are the sole responsibility of the client. Proud African Safaris will not assume responsibility for the accuracy of any medical information. You should consult your doctor for up to date requirements and personal recommendations..</td>
</tr>
<tr>
<td><strong>5. Airfares and Delays -</strong>Airfares are subject to change without notice prior to ticketing. Proud African Safaris is not responsible for any airline schedule or airfare changes, cancellations, overbooking or damage or loss of baggage and property. Any and all claims for any loss or injury suffered on any airline must be made directly with the airline involved. Air schedule changes may necessitate additional nights being added to your tour. These schedule changes are beyond the control of Proud African Safaris and any resulting additional costs must be borne by the guest. Proud African Safaris shall not be held liable for any delays or additional costs incurred as a result of airlines not running to schedule..</td>
</tr>
<tr>
<td><strong>6. Information-</strong>Proud African Safaris takes no responsibility for loss, damage or injury arising from any shortfall, error or omission in the information passed to the customer during the course of the sale or subsequent delivery of the product.</td>
</tr>
<tr>
<td><strong>7. Itinerary Changes -</strong>Although every effort is made to adhere to schedules, it should be noted that occasionally routes, lodges and camps may be changed while on safari as dictated by changing conditions. Such conditions may be brought about by seasonal rainfall on bush tracks, airfields and in game areas, by game migrations from one region to another, or airline or other booking problems, etc. Proud African Safaris shall not be held responsible for such itinerary changes as discussed above.</td>
</tr>
<tr>
<td><strong>8. Specific Accommodation-</strong>While our operators use their best endeavors to ensure that all reserved accommodation is available as planned, Proud African Safaris shall not be held responsible for a refund either in the whole or part, if any accommodation or excursion is unavailable and a reasonable alternative is found.</td>
</tr>
<tr>
<td><strong>9. Wild Animals -</strong>Please be aware that our safaris may take you into close contact with wild animals. Attacks by wild animals are rare, but no safari into the African wilderness can guarantee that this will not occur. Proud African Safaris shall not be held responsible for any injury or incident on the safari. Please note that many safari lodges and camps are not fenced and that wildlife does move freely in and around these areas. Always follow the safety instructions from the lodge or camp’s staff with regards to moving to and from your tent and while on game activities throughout your safari.</td>
</tr>
<tr>
<td><strong>10. Guest Representation and Consent-</strong>The person making any booking with Proud African Safaris, warrants that he or she has authority to enter into a contract on behalf of all other persons included in such a booking and in the event of the failure of any or all of the other persons so included to make payment, the person making the booking shall by his/her signature thereof assume personal liability of the total price of all bookings made by him/her.
The payment of the deposit or any other partial payment for a reservation on a tour constitutes a consent by all guests covered by that payment to all provisions of the Terms and Conditions contained herein whether the guest has signed the booking form or not.</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="page-break-before: always;"></div>
<table style="border: 1px solid; height: 5000px;" width="700" border="0" cellspacing="10" cellpadding="10">
<tbody>
<tr>
<td>
<table style="margin-top: 20px;" width="700">
<tbody>
<tr>
<td colspan="2"><strong>11. Assignment -“</strong>This contract may not be assigned by either party without the prior written consent of the other party.</td>
</tr>
<tr>
<td colspan="2"><strong>12. Severability -</strong>If any term of this contract is held by a court of competent jurisdiction to be void or unenforceable, the remainder of the contract terms shall remain in full force and effect and shall not be affected.</td>
</tr>
<tr>
<td colspan="2"><strong>13. Governing Law -“</strong>The validity of this contract and of any of its terms or provisions, as well as the rights and duties of the parties under this contract, shall be construed pursuant to and in accordance with the law of Massachusetts. The parties specifically agree to submit to the jurisdiction of the courts of Essex County, Massachusetts.</td>
</tr>
<tr>
<td colspan="2"><strong>14. Entire Agreement -“</strong>This contract supersedes any and all other agreements, either oral or in writing, between the parties with respect to the subject of this contract. This contract contains all of the covenants and agreements between the parties with respect to the subject of this contract, and each party acknowledges that no representation, inducements, promises, or agreements have been made by or on behalf of any party except the covenants and agreements embodied in this contract. No agreement, statement, or promise not contained in this contract shall be valid or binding between the parties with respect to the subject of this contract.</td>
</tr>
<tr>
<td colspan="2"><strong>15. Increase in Costs </strong>Tour costs quoted are current and are subject to change should there be any increases related to national park fees, lodging rates, governmental fees and taxes, internal airfare, airport taxes, visa fees, third party services or any other circumstance beyond our control.</td>
</tr>
<tr>
<td colspan="2"><strong>16. Agreement to Arbitrate - </strong>
You and we agree to submit any dispute arising under this agreement, except a dispute alleging criminal violations, to arbitration in accordance with the Uniform Rules for Binding Arbitration of the Better Business Bureau of the Southland (published online at www.labbb.org) in effect at the time of initiation of arbitration. A volunteer arbitrator will render a decision based upon fairness, not necessarily upon legal principles, but it will be final and binding on both of us. Judgment on the decision may be entered in any court having jurisdiction. You will not have to pay anything for the arbitration. This Agreement to Arbitrate affects important legal rights. Neither of us will be able to go to court for disputes once we agree in advance to arbitrate.</td>
</tr>
<tr>
<td colspan="2">I have read and accept the accompanying Booking Terms and Conditions. I understand and agree that I must also sign and return to Proud African Safaris a completed <strong>Travel Insurance Acceptance Form</strong> before my reservation will be confirmed. If I am signing on behalf of a minor, I agree to release, hold harmless and indemnify Proud African Safaris for any claims of the minor.
(If applicant is under 18 years of age, a parent or legal guardian must sign for the minor)</td>
</tr>
<tr>
<td width="50%">Participant Signature : '.$_REQUEST['participant_signature1'].'</td>
<td width="50%">Date : '.$_REQUEST['date1'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
<tr>
<td width="50%">Participant Signature : '.$_REQUEST['participant_signature2'].'</td>
<td width="50%">Date : '.$_REQUEST['date2'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="page-break-before: always;"></div>
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
<td colspan="2">For this reason, Proud African Safaris strongly urges all its clients to purchase a comprehensive travel insurance plan valid for the entire duration of their trip. This insurance should cover you for events such as trip cancellation, delay or interruption, lost or delayed baggage, emergency accident, illness and evacuation, 24-hour medical assistance, traveler™s assistance, and emergency cash transfer.</td>
</tr>
<tr>
<td colspan="2">For coverage, we suggest Travel Guard Insurance. The total premium will be based on each traveler™s age and total per person trip price, including airfares.</td>
</tr>
<tr>
<td colspan="2">Please visit the Travel Guard website online at<span class="color"> http://www.travelguard.com/.</span></td>
</tr>
<tr>
<td colspan="2"><span class="color">Please note that you must return this completed form to Proud African Safaris before your trip departure.</span> A completed Travel Insurance Acceptance Form is a condition of travel.
Please be aware that many insurance plans provide extra coverage when the travel insurance is purchased within<span class="color"> 15 days</span> of making the initial trip payment. Please read the Travel Guard brochure / application for a complete description of the travel insurance benefits and assistance services.</td>
</tr>
<tr>
<td colspan="2">
<h1>Please check one of the following:</h1>
</td>
</tr>
<tr>
<td colspan="2">I have read the brochure / application and have purchased a Travel Guard Comprehensive Tour Protection plan. I have included the policy number below so you may confirm my/our coverage.</td>
</tr>
<tr>
<td colspan="2">I have decided to purchase a comprehensive tour protection plan from another insurance company and have included details so you may confirm my/our coverage.</td>
</tr>
<tr>


<td colspan="2">Comprehensive travel insurance has been explained and recommended to me relative to my forthcoming trip; however, I have declined to purchase such insurance. I, the undersigned, accept full responsibility for, and will not hold Proud African Safaris responsible, for any loss or expense incurred which would have been covered by the recommended comprehensive travel insurance.</td>
</tr>
<tr>
<td width="50%">Participant Signature : '.$_REQUEST['participant_signature'].'</td>
<td width="50%">Date : '.$_REQUEST['date'].'</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;" colspan="2"></td>
</tr>
<tr>
<td width="50%">Print Name : '.$_REQUEST['print_name'].'</td>
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

$mail->AddAddress("sikandar.aghadiinfotech@gmail.com");
//$mail->AddAddress("carrie@mayodesigns.com");

//$mail->AddAddress("nandi@proudafricansafaris.com");
//$mail->AddAddress("steve@proudafricansafaris.com");
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
   echo "<span style='text-align: center;display: block; color: green; font-size: 20px;'>Thank you for Submitting your Information .</span>";
}



}else{
?>
<div class="main"><form id="frm_pdf" method="post" name="frm_pdf"><input type="hidden" name="pdf_insert" value="1" />

<input type="hidden" name="passport_full_name" value="<?php echo $_REQUEST['passport_full_name']?>">
<input type="hidden" name="passport_shirt_size" value="<?php echo $_REQUEST['passport_shirt_size']?>">
<input type="hidden" name="passport_number" value="<?php echo $_REQUEST['passport_number']?>">
<input type="hidden" name="passport_nationality" value="<?php echo $_REQUEST['passport_nationality']?>">
<input type="hidden" name="passport_issue_date" value="<?php echo $_REQUEST['passport_issue_date']?>">
<input type="hidden" name="passport_expiration_date" value="<?php echo $_REQUEST['passport_expiration_date']?>">
<input type="hidden" name="passport_place_of_issue" value="<?php echo $_REQUEST['passport_place_of_issue']?>">
<input type="hidden" name="passport_shirt_type" value="<?php echo $_REQUEST['passport_shirt_type']?>">
<input type="hidden" name="passport_date_of_birth" value="<?php echo $_REQUEST['passport_date_of_birth']?>">
<input type="hidden" name="passport_full_name2" value="<?php echo $_REQUEST['passport_full_name2']?>">
<input type="hidden" name="passport_shirt_size2" value="<?php echo $_REQUEST['passport_shirt_size2']?>">
<input type="hidden" name="passport_number2" value="<?php echo $_REQUEST['passport_number2']?>">
<input type="hidden" name="passport_nationality2" value="<?php echo $_REQUEST['passport_nationality2']?>">
<input type="hidden" name="passport_issue_date2" value="<?php echo $_REQUEST['passport_issue_date2']?>">
<input type="hidden" name="passport_expiration_date2" value="<?php echo $_REQUEST['passport_expiration_date2']?>">
<input type="hidden" name="passport_place_of_issue2" value="<?php echo $_REQUEST['passport_place_of_issue2']?>">
<input type="hidden" name="passport_shirt_type2" value="<?php echo $_REQUEST['passport_shirt_type2']?>">
<input type="hidden" name="passport_date_of_birth2" value="<?php echo $_REQUEST['passport_date_of_birth2']?>">
<input type="hidden" name="street" value="<?php echo $_REQUEST['street']?>">
<input type="hidden" name="city_state_zip" value="<?php echo $_REQUEST['city_state_zip']?>">
<input type="hidden" name="telephone_home" value="<?php echo $_REQUEST['telephone_home']?>">
<input type="hidden" name="telephone_work" value="<?php echo $_REQUEST['telephone_work']?>">
<input type="hidden" name="fax" value="<?php echo $_REQUEST['fax']?>">
<input type="hidden" name="email" value="<?php echo $_REQUEST['email']?>">
<input type="hidden" name="physical_condition" value="<?php echo $_REQUEST['physical_condition']?>">
<input type="hidden" name="dietary_requirement" value="<?php echo $_REQUEST['dietary_requirement']?>">
<input type="hidden" name="health_concerns" value="<?php echo $_REQUEST['health_concerns']?>">
<input type="hidden" name="emergency_contact_name" value="<?php echo $_REQUEST['emergency_contact_name']?>">
<input type="hidden" name="participant_signature1" value="<?php echo $_REQUEST['participant_signature1']?>">
<input type="hidden" name="date1" value="<?php echo $_REQUEST['date1']?>">
<input type="hidden" name="participant_signature2" value="<?php echo $_REQUEST['participant_signature2']?>">
<input type="hidden" name="date2" value="<?php echo $_REQUEST['date2']?>">
<input type="hidden" name="agree1" value="<?php echo $_REQUEST['agree1']?>">



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
<td>For this reason, Proud African Safaris strongly urges all its clients to purchase a comprehensive travel insurance plan valid for the entire duration of their trip. This insurance should cover you for events such as trip cancellation, delay or interruption, lost or delayed baggage, emergency accident, illness and evacuation, 24-hour medical assistance, traveler™s assistance, and emergency cash transfer.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>For coverage, we suggest Travel Guard Insurance. The total premium will be based on each traveler™s age and total per person trip price, including airfares.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>Please visit the Travel Guard website online at<span class="color"> http://www.travelguard.com/.</span></td>
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
<td>I have read the brochure / application and have purchased a Travel Guard Comprehensive Tour Protection plan. I have included the policy number below so you may confirm my/our coverage.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>I have decided to purchase a comprehensive tour protection plan from another insurance company and have included details so you may confirm my/our coverage.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td>Comprehensive travel insurance has been explained and recommended to me relative to my forthcoming trip; however, I have declined to purchase such insurance. I, the undersigned, accept full responsibility for, and will not hold Proud African Safaris responsible, for any loss or expense incurred which would have been covered by the recommended comprehensive travel insurance.</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="25%">Participant Signature : </td>
<td width="25%"><div class="er"><input id="participant_signature" type="text" name="participant_signature" class="required"  /></div></td>
<td width="15%">Date : </td>
<td width="35%"><div class="er"><input id="date" type="text" name="date" class="required date" /></div></td>
</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
<tr>
<td>Print Name : </td>
<td width="25%"><div class="er"><input id="print_name" type="text" name="print_name" class="required"/></div></td>
<td width="25%">Trip Dates : </td>
<td width="25%"><div class="er"><input id="trip_dates" type="text" name="trip_dates" class="required date" /></div></td>
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
<div class="er-radio" ><input id="date2" type="radio" name="agree1" class="required"/></div><div style="overflow:hidden">I Agree : By clicking in the box marked "I agree," you consent to the use of electronic signatures in connection with your Proud African Safari Booking. You understand that your electronic signature is legally binding, just as if you had signed a paper document. </div>
</td>

</tr>

<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
<tr>
<td colspan="4"  style="text-align: center;" align="center">
<input id="submit" style="font-size: 21px; height: 40px; width: 132px;" type="submit" name="submit" value="Submit" />
</td>
</tr>
</tbody>
</table>
</form></div>
<?php } 
get_footer();
?>
