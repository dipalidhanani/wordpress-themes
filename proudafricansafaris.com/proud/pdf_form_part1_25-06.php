<?php
/**
 * Template Name: PDF1 Template
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


<div class="main"><form id="frm_pdf" method="post" name="frm_pdf" action="travel-insurance-acceptance">
<input type="hidden" name="pdf_insert" value="1" />
<input type="hidden" name="pdf_genrate" value="2" />
<table width="100%" border="0" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="2" style="text-align: center;"><img src="http://proudafricansafaris.com/wp-content/uploads/2013/06/img.png" alt="" width="300" height="145" /></td>
</tr>
<tr>
<td colspan="2" style="text-align: center;"><strong><h1>Reservations Booking Form</h1></strong>
</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2"></td>
</tr>
<tr>
<td colspan="2">Please read the attached Booking Terms and Conditions carefully before signing. All guests must sign and complete this form and return it to us with a $1,000.00per person non-refundable deposit to have a confirmed reservation.Privacy: All information is used solely by Proud African Safaris and its contracted tour operators / airlines in planning your tour.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="4"><strong>Passport Details (Traveler #1)</strong></td>
</tr>
<tr style="border-bottom: 1px solid #444444;">
<td width="25%">Full Name
(As appears in passport) :</td>
<td width="26%">
<div class="er"><input id="passport_full_name" type="text" name="passport_full_name" class="required" /></div>
</td>
<td width="21%">Shirt Size :</td><td width="28%">
<div class="er"><select name="passport_shirt_size" class="required"> 
<option selected="selected" value="S">S</option> 
<option value="M">M</option> 
<option value="L">L</option> 
<option value="XL">XL</option> 
<option value="XXL">XXL</option> 
</select>
</div>
</td>
</tr>
<tr>
<td>Passport Number : </td><td><div class="er"><input id="passport_number" type="text" name="passport_number" class="required" /></div></td>
<td>Passport Nationality : </td><td><div class="er"><input id="passport_nationality" type="text" name="passport_nationality" class="required"/></div></td>
</tr>
<tr>
<td>Issue Date : </td><td><div class="er"><input id="passport_issue_date" type="text" name="passport_issue_date"  class="required date"/></div></td>
<td>Expiration Date : </td><td><div class="er"><input id="passport_expiration_date" type="text" name="passport_expiration_date" class="required date" /></div></td>
</tr>
<tr>
<td>Place of issue : </td><td><div class="er"><input id="passport_place_of_issue" type="text" name="passport_place_of_issue"  class="required"/></div></td>
<td>Sex :</td><td>
<div class="er"><select name="passport_shirt_type">
<option selected="selected" value="M">M</option>
<option value="F">F</option> 
</select></div></td>
</tr>
<tr>
<td>Date of birth : </td><td><div class="er"><input id="passport_date_of_birth" type="text" name="passport_date_of_birth" class="required date" /></div></td>
<td></td><td></td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="2"><strong>Passport Details (Traveler #2)</strong></td>
</tr>
<tr>
<td width="25%">Full Name
(As appears in passport) : </td><td width="26%"><input id="passport_full_name2" type="text" name="passport_full_name2" /></td>
<td width="21%">Shirt Size :</td><td width="28%">
<select name="passport_shirt_size2"  >
<option selected="selected" value="S">S</option> 
<option value="M">M</option>
<option value="L">L</option> 
<option value="XL">XL</option> 
<option value="XXL">XXL</option> 
</select>
</td>
</tr>
<tr>
<td>Passport Number : </td><td><input id="passport_number2" type="text" name="passport_number2"/></td>
<td>Passport Nationality : </td><td><input id="passport_nationality2" type="text" name="passport_nationality2"/></td>
</tr>
<tr>
<td>Issue Date : </td><td><input id="passport_issue_date2" type="text" name="passport_issue_date2" /></td>
<td>Expiration Date : </td><td><input id="passport_expiration_date2" type="text" name="passport_expiration_date2" /></td>
</tr>
<tr>
<td>Place of issue : </td><td><input id="passport_place_of_issue2" type="text" name="passport_place_of_issue2" /></td>
<td>Sex :</td><td>
<select name="passport_shirt_type2">
<option selected="selected" value="M">M</option> 
<option value="F">F</option>
</select>
</td>
</tr>
<tr>
<td>Date of birth : </td><td><input id="passport_date_of_birth2" type="text" name="passport_date_of_birth2" /></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="4"><strong>Personal Details</strong></td>
</tr>
<tr>
<td width="25%">Street (As appears in passport) :</td><td width="26%"><div class="er"><input id="street" type="text" name="street"  class="required" /></div></td>
<td colspan="2"></td>
</tr>
<tr>
<td>City State Zip :</td><td><div class="er"><input id="city_state_zip" type="text" name="city_state_zip" class="required"/></div></td>
<td colspan="2"></td>
</tr>
<tr>
<td width="25%">Telephone(Home) : </td><td width="26%"><div class="er"><input id="telephone_home" type="text" name="telephone_home" class="required number" /></div></td>
<td width="21%">(Work) : </td><td width="28%"><div class="er"><input id="telephone_work" type="text" name="telephone_work" /></div></td>
</tr>
<tr>
<td>Fax : </td><td><div class="er"><input id="fax" type="text" name="fax" class="number" /></div></td>
<td>Email :</td><td>
<div class="er"><input id="email" type="text" name="email"  class="required email"/></div></td>
</tr>
<tr>
<td>Physical Condition : </td><td><div class="er"><input id="physical_condition" type="text" name="physical_condition" class="required" /></div></td>
<td>Dietary Requirement : </td><td><div class="er"><input id="dietary_requirement" type="text" name="dietary_requirement" class="required"/></div></td>
</tr>
<tr>
<td >Health Concerns : </td><td><div class="er"><input id="health_concerns" type="text" name="health_concerns" class="required"/></div></td>
<td colspan="2"></td>
</tr>
<tr>
<td>Emergency Contact Name &amp; Telephone : </td><td><div class="er"><input id="emergency_contact_name" type="text" name="emergency_contact_name" class="required"/></div></td>
<td colspan="2"></td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>BOOKING TERMS AND CONDITIONS
</strong></td>
</tr>
<tr>
<td colspan="2">Proud African Safaris is a trading name of Proud African Safaris LLC, a Limited Liability Corporation registered in the Commonwealth of Massachusetts. The following terms as used in these Booking Terms and Conditions shall be considered synonymous: safari,tour, and trip, all of which refer to the travel arrangements being booked with Proud African Safaris. Additionally, the following terms:client,guest,participant, member, passenger and traveler all refer to you, as the traveler. Booking Terms and Conditions Placement of an order with Proud African Safaris is taken as acceptance of the following terms and conditions.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>1. Reservations and Payments - </strong>Payment of a non-refundable deposit in the amount of $1,000.00 per person along with a completed and signed Reservation Booking Form and Travel Insurance Acceptance Form are required in order to confirm your reservation.All payments are to be done by wire transfer or check overnight to the office in Marblehead, Massachusetts. Proud African Safaris will also accept Visa or Mastercard for those individuals wishing to pay for their deposits and safaris with credit cards, however, a 3.31% service charge will then be added to the total cost of the safari.Upon receipt of deposit and reservation booking form, we will, subject to availability, reserve your place on your selected safari. In the event that any accommodation is not available we will substitute a comparable property or adjust the itinerary if necessary without compromising the integrity of the overall safari experience. The balance of the safari price is due in-full not later than 90 days prior to departure. All prices are quoted in U.S. dollars and must be paid in U.S. dollars.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>2. Cancellation and Refund Policy: </strong>Cancellations are only effective upon our receipt of written notification, signed by the client. If cancellation is made prior to 90 days before departure, your $1,000.00 per person deposit is forfeited but any additional payments made prior to the 90 days before departure will be refunded in-full. If your cancellation is made after the due date for full payment of your trip fare, payment cannot be refunded by Proud African Safaris. See below: <br>
 • More than 90 days notice prior to departure date-Deposit forfeited, subsequent payments refunded <br>
 • 89-0 days notice prior to departure date–100% lost Should you fail to join a tour or join it after departure or leave it prior to its completion, no tour fare refund will be made. Some airfare may be non refundable. <br>
 There will be no refunds from Proud African Safaris for any unused portions of the tour. The above policy applies to all travel arrangements made via Proud African Safaris.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>3. Insurance -</strong> It is a condition of booking that the sole responsibility lies with the guest to ensure that they carry the correct comprehensive travel and medical insurance to cover themselves, as well as any dependants and traveling companions for the duration of their tour to Africa. This insurance should include coverage in respect of, but not limited to, the following eventualities: cancellation or curtailment of the safari, emergency evacuation expenses, medical expenses, repatriation expenses, damage, theft or loss of personal baggage, money and goods. Proud African Safaris will take no responsibility for any costs for losses incurred or suffered by the guest, or guest's dependants or traveling companions, with regards to, but not limited to, any of the above mentioned eventualities. Guests will be charged directly by the relevant service providers for any emergency services they may require, and may find themselves in a position unable to access such services should they not be carrying the relevant insurance coverage. A Travel Insurance Acceptance Form must be completed and returned to Proud African Safaris as a condition of travel.</td>
</tr>
</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>4. Medical and Health -</strong>Participation on a safari or tour to East Africa requires that you be in generally good health. All guests must understand that while a high level of fitness is not required, a measure of physical activity is involved in all African safaris and tours. It is essential that persons with any medical problems and/or related dietary restrictions make them known to us well before departure. Anti-malaria precautions should be taken, and these are the sole responsibility of the client. Proud African Safaris will not assume responsibility for the accuracy of any medical information. You should consult your doctor for up to date requirements and personal recommendations..</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>5. Airfares and Delays -</strong>Airfares are subject to change without notice prior to ticketing. Proud African Safaris is not responsible for any airline schedule or airfare changes, cancellations, overbooking or damage or loss of baggage and property. Any and all claims for any loss or injury suffered on any airline must be made directly with the airline involved. Air schedule changes may necessitate additional nights being added to your tour. These schedule changes are beyond the control of Proud African Safaris and any resulting additional costs must be borne by the guest. Proud African Safaris shall not be held liable for any delays or additional costs incurred as a result of airlines not running to schedule..</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>6. Information-</strong>Proud African Safaris takes no responsibility for loss, damage or injury arising from any shortfall, error or omission in the information passed to the customer during the course of the sale or subsequent delivery of the product.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>7. Itinerary Changes -</strong>Although every effort is made to adhere to schedules, it should be noted that occasionally routes, lodges and camps may be changed while on safari as dictated by changing conditions. Such conditions may be brought about by seasonal rainfall on bush tracks, airfields and in game areas, by game migrations from one region to another, or airline or other booking problems, etc. Proud African Safaris shall not be held responsible for such itinerary changes as discussed above.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>8. Specific Accommodation-</strong>While our operators use their best endeavors to ensure that all reserved accommodation is available as planned, Proud African Safaris shall not be held responsible for a refund either in the whole or part, if any accommodation or excursion is unavailable and a reasonable alternative is found.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>9. Wild Animals -</strong>Please be aware that our safaris may take you into close contact with wild animals. Attacks by wild animals are rare, but no safari into the African wilderness can guarantee that this will not occur. Proud African Safaris shall not be held responsible for any injury or incident on the safari. Please note that many safari lodges and camps are not fenced and that wildlife does move freely in and around these areas. Always follow the safety instructions from the lodge or camp's staff with regards to moving to and from your tent and while on game activities throughout your safari.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>10. Guest Representation and Consent-</strong>The person making any booking with Proud African Safaris, warrants that he or she has authority to enter into a contract on behalf of all other persons included in such a booking and in the event of the failure of any or all of the other persons so included to make payment, the person making the booking shall by his/her signature thereof assume personal liability of the total price of all bookings made by him/her.
The payment of the deposit or any other partial payment for a reservation on a tour constitutes a consent by all guests covered by that payment to all provisions of the Terms and Conditions contained herein whether the guest has signed the booking form or not.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>11. Assignment-</strong>This contract may not be assigned by either party without the prior written consent of the other party.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>12. Severability -</strong>If any term of this contract is held by a court of competent jurisdiction to be void or unenforceable, the remainder of the contract terms shall remain in full force and effect and shall not be affected.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>13. Governing Law-</strong>The validity of this contract and of any of its terms or provisions, as well as the rights and duties of the parties under this contract, shall be construed pursuant to and in accordance with the law of Massachusetts. The parties specifically agree to submit to the jurisdiction of the courts of Essex County, Massachusetts.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>14. Entire Agreement-</strong>This contract supersedes any and all other agreements, either oral or in writing, between the parties with respect to the subject of this contract. This contract contains all of the covenants and agreements between the parties with respect to the subject of this contract, and each party acknowledges that no representation, inducements, promises, or agreements have been made by or on behalf of any party except the covenants and agreements embodied in this contract. No agreement, statement, or promise not contained in this contract shall be valid or binding between the parties with respect to the subject of this contract.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>15. Increase in Costs-</strong>Tour costs quoted are current and are subject to change should there be any increases related to national park fees, lodging rates, governmental fees and taxes, internal airfare, airport taxes, visa fees, third party services or any other circumstance beyond our control.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td><strong>16. Agreement to Arbitrate -</strong>You and we agree to submit any dispute arising under this agreement, except a dispute alleging criminal violations, to arbitration in accordance with the Uniform Rules for Binding Arbitration of the Better Business Bureau of the Southland (published online at www.labbb.org) in effect at the time of initiation of arbitration. A volunteer arbitrator will render a decision based upon fairness, not necessarily upon legal principles, but it will be final and binding on both of us. Judgment on the decision may be entered in any court having jurisdiction. You will not have to pay anything for the arbitration. This Agreement to Arbitrate affects important legal rights. Neither of us will be able to go to court for disputes once we agree in advance to arbitrate.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td>-I have read and accept the accompanying Booking Terms and Conditions. I understand and agree that I must also sign and return to Proud African Safaris a completed <strong>Travel Insurance Acceptance Form</strong> before my reservation will be confirmed. If I am signing on behalf of a minor, I agree to release, hold harmless and indemnify Proud African Safaris for any claims of the minor.-
(If applicant is under 18 years of age, a parent or legal guardian must sign for the minor)</td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="25%">Participant Signature : </td>
<td width="26%"> <div class="er"><input id="participant_signature1" type="text" name="participant_signature1" class="required"/></div></td>

<td width="25%" >Date :</td>
<td width="26%"><div class="er"> <input id="date1" type="text" name="date1" class="required date" /></div></td>

</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
</tbody>
</table>
<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="25%">Participant Signature :</td>
<td width="26%"><div class="er"> <input id="participant_signature2" type="text" name="participant_signature2" ></div></td>

<td width="25%">Date : </td>
<td width="26%"><div class="er"><input id="date2" type="text" name="date2" class="date"/></div></td>

</tr>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
</tbody>
</table>

<table style="padding: 10px;" width="100%">
<tbody>
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
<input id="submit" style="font-size: 21px; height: 40px; width: 132px;" type="submit" name="submit" value="Next" />
</td>
</tr>
</tbody>
</table>
</form></div>
<?php  
get_footer();
?>
