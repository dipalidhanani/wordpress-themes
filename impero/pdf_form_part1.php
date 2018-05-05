<?php
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
 */
 
/*
Template Name: Application for employement
*/
    
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */
 get_header()
 ?>
 <style>/*.page-template-pdf_form_part1-php .bannerlinks1{display:none;}
 .page-template-pdf_form_part1-php .leftbar{display:none;}
 .rightbar{width:98%;}*/
 .para label.error{color:#F00; width:auto;}
 </style>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	 jQuery("#frm_pdf").validate();
  });
</script>
  <?php 
	  get_sidebar(); 
	  global $post;
	  $val=get_post_meta($post->ID,'page_banner', true);
	  ?>  
 </div>
   <div class="rightbar">

<div class="banner"><img src="<?php echo $val ?>" /></div>
        <!--<div class="layout-sidebar-no group">-->
		
            <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>
        
            <!-- START CONTENT -->
            
                <?php if( yiw_layout_page() != 'sidebar-no' && get_post_meta( get_the_ID(), '_show_title_page', true ) == 'no' ): ?>
                    <div class="posts_space"></div>
                <?php endif; ?>
                
                <?php get_template_part( 'loop', 'page' ) ?>
                <?php comments_template() ?>
      
            <!-- END CONTENT -->

                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->  
       

 
<?php
if($_POST["pdf_insert"]=='1') {
$html='<table width="700" border="0" cellspacing="0" cellpadding="5" style="" >
<tr><td colspan="2" align="center" style="padding:5px;"><img src="http://salmonfallsnurseryandlandscaping.com/wp-content/themes/innocente/images/logo.png" height="120" width="245" border="0" /></td></tr>
<tr>
<td colspan="2" style="text-align: center;"><strong><h1>APPLICATION FOR EMPLOYMENT</h1></strong>
</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2"></td>
</tr>
<tr>
<td colspan="2">Salmon Falls Nursery & Landscaping, Inc. is an equal opportunity employer and does not discriminate on the basis of race, religion, color, national origin, age, sex, gender, disability, genetic information, or any other characteristic protected by law.</td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
 <tr>
<td colspan="4"><strong>INTRODUCTORY INFORMATION:</strong></td>
</tr>
<tr style="border-bottom: 1px solid #444444;">
<td width="25%">Name:</td>
<td width="26%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_name'].'</td>
<td width="21%">Date :</td><td width="28%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_date'].'</td>
</tr>
<tr>
<td>Address : </td><td style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_address'].'</td>
<td>City : </td><td style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_city'].'</td>
</tr>
<tr>
<td>State : </td><td style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_state'].'</td>
<td>Zip : </td><td style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_zip'].'</td>
</tr>
<tr>
<td>Email : </td><td style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_email'].'</td>
<td>Phone :</td><td style="border-bottom: 1px solid #444444;">'.$_REQUEST['introductory_phone'].'</td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px; " width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="2"><strong>APPLICANT QUESTIONS:</strong></td>
</tr>
<tr>
<td width="17%">Type of worked desired: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_type_of_work'].'</td>
<td width="13%">Salary desired:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['applicant_salary_desired'].'</td>
<td width="9%">Date Available: </td><td width="27%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['passport_number2'].'</td>
</tr>
<tr>
<td colspan="3">If hired, can you provide documents required to establish your eligibility to work in the U.S.? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_can_you_provide_document'].'</td>
</tr>
<tr>
<td colspan="3">Are you at least 18 years of age? </td><td style="border-bottom: 1px solid #444444;">
'.$_REQUEST['applicant_are_you_atleast_18'].'</td>
</tr>
<tr>
<td colspan="3">If you are under 18, and it is required, can you furnish a work permit?</td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_can_you_furnish_work_permit'].'</td>
</tr>
<tr>
<td colspan="3">Do you have a valid Drivers License? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_do_you_have_driver_license'].'
</td>
</tr>
<tr>
<td colspan="3">How were you referred Salmon Falls Nursery? </td><td colspan="3" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['applicant_how_were_you_referred_nursery'].'</td>

</tr>
<tr>
<td colspan="3">Have you ever been convicted of, or pled guilty or no contest to, a crime other than a minor traffic violation? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_have_you_ever_been_convicted_of'].'
</td>
</tr>
</tbody>
</table>
<div style="page-break-before: always;"></div>
<table style="margin-top: 20px; font-size:15px; " width="100%" cellspacing="10" cellpadding="5" >
<tbody>
<tr>
<td colspan="4"><strong>EDUCATION:</strong></td>
</tr>
<tr><td colspan="3">High School or last grade completed: '.$_REQUEST['high_school_completed'].'</td></tr>
<tr>
<td width="25%">Name & Address of School:	</td><td width="26%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['school_name_address'].'</td>
</tr>
<tr>
<td width="17%">Course Study: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['education_course_of_study_school'].'</td>
<td width="13%">Last grade completed:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['education_last_grade_completed_school'].'
</td>
<td width="9%">Degree/Diploma: </td><td width="27%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['education_degree_diploma_school'].'</td>
</tr>
<tr><td>College or Technical School: '.$_REQUEST['college_technical_school'].'</td></tr>
<tr>
<td width="25%">Name & Address of School:	</td><td width="26%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['college_name_address'].'</td>
</tr>
<tr>
<td width="17%">Course Study: </td><td width="18%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['education_course_of_study_college'].'
</td>
<td width="13%">Last grade completed:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['education_last_grade_completed_college'].'
</td>
<td width="9%">Degree/Diploma: </td><td width="27%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['education_degree_diploma_college'].'</td>
</tr>
<tr><td>Other Schooling or Training: '.$_REQUEST['other_schooling_training'].'</td></tr>
<tr>
<td width="25%">Name & Address of School:	</td><td width="26%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['other_name_address'].'</td>
</tr>
<tr>
<td width="17%">Course Study: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['education_course_of_study_other'].'</td>
<td width="13%">Last grade completed:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['education_last_grade_completed_other'].'
</td>
<td width="9%">Degree/Diploma: </td><td width="27%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['education_degree_diploma_other'].'
</td>
</tr>
</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>SPECIAL SKILS AND CERFICATIONS:</strong></td>
</tr>
<tr>
<td colspan="2">Summarize any training, skills, licenses and / or certificates that may qualify you as being able to perform job-related functions in the position for which you are applying: 
<div style="border-bottom: 1px solid #444444;">'.$_REQUEST['special_skills_summarize_any_training'].'</div>
</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>MILITARY EXPERIENCE:</strong></td>
</tr>
<tr>
<td width="20%">Branch of Service:</td>
<td width="80%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['military_branch_of_service'].'
</td>
</tr>
<tr>
<td>Rank/Type of Service:</td>
<td style="border-bottom: 1px solid #444444;">
'.$_REQUEST['military_rank_of_service'].'
</td>
</tr>
<tr>
<td>Job-Related Training/Experience: </td>
<td style="border-bottom: 1px solid #444444;">
'.$_REQUEST['military_job_related_training'].'
</td>
</tr>
</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>RECORD OF EMPLOYMENT: </strong>List positions starting with most recent</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px; border: 1px solid #ddd;font-size:15px; " width="100%">
<tbody>
<tr>
<td width="17%">Employer: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_employer'].'</td>
<td width="13%">Telephone:</td><td width="16%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_telephone'].'
</td>
<td colspan="4"></td>
</tr>
<tr>
<td width="17%">Address: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_address'].'</td>
<td></td>
</tr>
<tr>
<td width="17%">Position Title: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_position_title'].'</td>
<td width="13%">Supervisor name/email/phone: </td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_supervisor_name'].'
</td>
<td colspan="4"></td>
</tr>
<tr>
<td width="17%">Start Date: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_start_date'].'</td>
<td width="13%">Date Left:</td><td width="16%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_date_left'].'
</td>
<td width="13%">Beginning Salary:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_beginning_salary'].'
</td>
<td width="13%">Ending Salary:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_ending_salary'].'
</td>
</tr>
<tr>
<td width="17%">Duties: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_duties'].'</td>
<td></td>
</tr>
<tr>
<td width="17%">Reason for Leaving: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_reason_for_leaving'].'</td>
<td></td>
</tr>
<tr>
<td colspan="3">Where you subject to FMCSR while working for this company? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_where_you_subject_to'].'</td>
<td colspan="4"></td>
</tr>
<tr>
<td colspan="3">Was your job with this company designated as a safety sensitive function subject to drug and alcohol testing requirements of 49 CFR </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_was_your_job_with_this_company'].'
</td>
<td colspan="4"></td>
</tr>

</tbody>
</table>
<div style="page-break-before: always;"></div>
<table style="margin-top: 10px; padding: 10px;border: 1px solid #ddd;font-size:15px; " width="100%">
<tbody>
<tr>
<td width="17%">Employer: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_employer2'].'</td>
<td width="13%">Telephone:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_telephone2'].'
</td>
<td colspan="4"></td>
</tr>
<tr>
<td width="17%">Address: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_address2'].'</td>
</tr>
<tr>
<td width="17%">Position Title: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_position_title2'].'</td>
<td width="13%">Supervisor name/email/phone: </td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_supervisor_name2'].'
</td>
<td colspan="4"></td>
</tr>
<tr>
<td width="17%">Start Date: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_start_date2'].'</td>
<td width="13%">Date Left:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_date_left2'].'</td>
<td width="13%">Beginning Salary:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_beginning_salary2'].'
</td>
<td width="13%">Ending Salary:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_ending_salary2'].'
</td>
</tr>
<tr>
<td width="17%">Duties: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_duties2'].'</td>
<td></td>
</tr>
<tr>
<td width="17%">Reason for Leaving: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_reason_for_leaving2'].'</td>
<td></td>
</tr>
<tr>
<td colspan="3">Where you subject to FMCSR while working for this company? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_where_you_subject_to2'].'</td>
<td colspan="4"></td>
</tr>
<tr>
<td colspan="3">Was your job with this company designated as a safety sensitive function subject to drug and alcohol testing requirements of 49 CFR </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_was_your_job_with_this_company2'].'</td>
<td colspan="4"></td>
</tr>

</tbody>
</table>

<table style="margin-top: 10px; padding: 10px; border: 1px solid #ddd;font-size:15px; " width="100%">
<tbody>
<tr>
<td width="17%">Employer: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_employer3'].'</td>
<td width="13%">Telephone:</td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_telephone3'].'
</td>
<td colspan="4"></td>
</tr>
<tr>
<td width="17%">Address: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_address'].'</td>
<td></td>
</tr>
<tr>
<td width="17%">Position Title: </td><td width="18%">'.$_REQUEST['record_position_title3'].'</td>
<td width="13%">Supervisor name/email/phone: </td><td width="16%" style="border-bottom: 1px solid #444444;">
'.$_REQUEST['record_supervisor_name3'].'
</td>
<td colspan="4"></td>
</tr>
<tr>
<td width="17%">Start Date: </td><td width="18%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_start_date3'].'</td>
<td width="13%">Date Left:</td><td width="16%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_date_left3'].'</td>
<td width="13%">Beginning Salary:</td><td width="16%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_beginning_salary3'].'
</td>
<td width="13%">Ending Salary:</td><td width="16%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_ending_salary3'].'</td>
</tr>
<tr>
<td width="17%">Duties: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_duties3'].'</td>
<td></td>
</tr>
<tr>
<td width="17%">Reason for Leaving: </td><td width="18%" colspan="6" style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_reason_for_leaving3'].'</td>
<td></td>
</tr>
<tr>
<td colspan="3">Where you subject to FMCSR while working for this company? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_where_you_subject_to3'].'</td>
<td colspan="4"></td>
</tr>
<tr>
<td colspan="3">Was your job with this company designated as a safety sensitive function subject to drug and alcohol testing requirements of 49 CFR </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['record_was_your_job_with_this_company3'].'</td>
<td colspan="4"></td>
</tr>

</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Driver-Experience and Qualification (to be completed only if applying for driving position)</strong></td>
</tr>
<tr>
<td colspan="2">(Complete if you have driven a company vehicle subjected to FMCSR- Federal Motor Carrier Safety Administration)</td>
</tr>
</tbody>
</table>
<table width="100%" style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12%" rowspan="4" style="border-right:1px solid #444;border-bottom:1px solid #444;"><p align="center">Drivers Licenses</p>
</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;" >State</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">License #</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Type</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Expiration Date</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_state1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_number1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_type1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_expiration_date1'].'</td>
  </tr>
   <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_state2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_number2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_type2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_expiration_date2'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_state3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_number3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_type3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['license_expiration_date3'].'</td>
  </tr>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Driving Experience</strong></td>
</tr>
</tbody>
</table>
<table width="100%" style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="14%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Class of Equipment</td>
    <td width="27%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><p style="text-align:center;">Type of Equipment<br />(Van, Tank, Flat, Etc.)</p></td>
    <td colspan="2" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><p style="text-align:center;">Dates<br />
From                                               To</p></td>
    <td width="33%" style="border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Straight Truck</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['type_of_equipment1'].'</td>
    <td width="13%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['from_date1'].'</td>
    <td width="13%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['to_date1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['other1'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Tractor &amp; Semi-Tractor</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['type_of_equipment2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['from_date2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['to_date2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['other2'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Tractor Two Trailers</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['type_of_equipment3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['from_date3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['to_date3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['other3'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Other</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['type_of_equipment4'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['from_date4'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['to_date4'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['other4'].'</td>
  </tr>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Accident record for the past 3 years or more (attach sheet if more space is needed)</strong></td>
</tr>
</tbody>
</table>
<table width="100%"  style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Dates</td>
    <td width="39%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Nature of accident (head-on, rear-end, upset,  etc.)</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Fatalities</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Injuries</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Last Accident</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['nature_of_accident1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['fatalities1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['injuries1'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Previous</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['nature_of_accident2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['fatalities2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['injuries2'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Previous</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['other4'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['fatalities3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">'.$_REQUEST['injuries3'].'</td>
  </tr>
</table>
<div style="page-break-before: always;"></div>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Traffic convictions and forfeitures for the past 3 years (other than parking violations)</strong></td>
</tr>
</tbody>
</table>
<table width="100%"  style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Location</td>
    <td width="39%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Date</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Charge</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Penalty</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_location1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_date1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_charge1'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_penalty1'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_location2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_date2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_charge2'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_penalty2'].'</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_location3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_date3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_charge3'].'</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;'.$_REQUEST['traffic_penalty3'].'</td>
  </tr>
</table>
<table width="100%">
<tbody>
<tr>
<td colspan="2" style="text-align:center;">(Attach sheet if more space is needed)</td>
</tr>
</tbody>
</table>

<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td  width="69%">Have you ever been denied a license, permit or privilege to operate a motor vehicle? </td>
<td style="border-bottom: 1px solid #444444;" width="31%">'.$_REQUEST['have_you_ever_been_denied_a_license'].'</td>
</tr>

<tr>
<td>Have any license, permit or privilege ever been suspended or revoked? </td>
<td style="border-bottom: 1px solid #444444;">'.$_REQUEST['have_any_license_permit'].'</td>
</tr>
</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2" style="text-align:center;"><strong>Driver Applicants</strong></td>
</tr>
<tr>
<td colspan="2">Please understand that information you provide regarding, current and previous employers may be used and those employers will be contacted for the purpose of investigating your safety performance history as required by 49 CFR 391.23 (d) and (e).  </td>
</tr>
</tbody>
</table>

<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="25%">Applicant Name : </td>
<td width="26%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_signature'].'</td>
<td width="25%" >Date :</td>
<td width="26%" style="border-bottom: 1px solid #444444;">'.$_REQUEST['applicant_date'].'</td>
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
//$mail->AddAddress("nandi@proudafricansafaris.com");
//$mail->AddAddress("steve@proudafricansafaris.com");

$mail->AddAddress("Cindy@salmonfallsnursery.com");
$mail->addCC('mayotest21@gmail.com');
$mail->Subject = "PDF Attachment";
$mail->Body = "Please find PDF Attachment.";
$mail->SetFrom("info@salmonfallsnursery.com");    
$mail->AddReplyTo("Cindy@salmonfallsnursery.com");
$mail->AddAttachment($filename) ;
if(!$mail->Send())
{
   echo "Error sending: " . $mail->ErrorInfo;
}
else
{
	echo '<table width="100%" border="0" cellspacing="10" cellpadding="5">
	<tbody>
<tr><td colspan="2" align="center" style="padding:5px;"><img src="http://salmonfallsnurseryandlandscaping.com/wp-content/themes/innocente/images/logo.png" height="120" width="245" border="0" /></td></tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2"></td>
</tr>
<tr>
<td colspan="2"><span style="text-align: center;display: block; color: green; font-size: 20px;"> Thank you for your submission.</span></td>
</tr>
</tbody>
</table>';
}



}else{
?>

<div class="main"><form id="frm_pdf" method="post" name="frm_pdf" class="para" >
<input type="hidden" name="pdf_insert" value="1" />
<!--<table width="100%" border="0" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="2" style="text-align: center;"><strong><h1>APPLICATION FOR EMPLOYMENT</h1></strong>
</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #444444;" colspan="2"></td>
</tr>
<tr>
<td colspan="2">Salmon Falls Nursery & Landscaping, Inc. is an equal opportunity employer and does not discriminate on the basis of race, religion, color, national origin, age, sex, gender, disability, genetic information, or any other characteristic protected by law.</td>
</tr>
</tbody>
</table>
-->
<br>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="4"><strong>INTRODUCTORY INFORMATION:</strong></td>
</tr>
<tr style="border-bottom: 1px solid #444444;">
<td width="11%">*Name:</td>
<td width="40%">
<div class="er"><input id="introductory_name" type="text" name="introductory_name" class="required" style="width:280px;" /></div>
</td>
<td width="9%">*Date :</td><td width="40%">
<div class="er"><input id="introductory_date" type="text" name="introductory_date" class="required" style="width:300px;" />
</div>
</td>
</tr>
<tr>
<td>*Address : </td><td><div class="er"><input id="introductory_address" type="text" class="required" name="introductory_address" style="width:280px;" /></div></td>
<td>*City : </td><td><div class="er"><input id="introductory_city" type="text" class="required" name="introductory_city" style="width:300px;" /></div></td>
</tr>
<tr>
<td>*State : </td><td><div class="er"><input id="introductory_state" type="text" class="required" name="introductory_state" style="width:280px;" /></div></td>
<td>*Zip : </td><td><div class="er"><input id="introductory_zip" type="text" class="required" name="introductory_zip" style="width:300px;" /></div></td>
</tr>
<tr>
<td>Email : </td><td><div class="er"><input id="introductory_email" type="text" name="introductory_email" style="width:280px;" /></div></td>
<td>*Phone :</td><td>
<div class="er"><input id="introductory_phone" type="text" name="introductory_phone" class="required" style="width:300px;" /></div></td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="6"><strong>APPLICANT QUESTIONS:</strong></td>
</tr>
<tr>
<td width="37%">Type of worked desired: </td><td width="12%"><input id="applicant_type_of_work" type="text" name="applicant_type_of_work" style="width:105px;" /></td>
<td width="20%">Salary desired:</td><td width="12%">
<input id="applicant_salary_desired" type="text" name="applicant_salary_desired" style="width:105px;"/>
</td>
<td width="42%">Date Available: </td><td width="12%"><input id="passport_number2" type="text" name="passport_number2" style="width:105px;"/></td>
</tr>
<tr>
<td colspan="4">*If hired, can you provide documents required to establish your eligibility to work in the U.S.? </td>
<td colspan="2"><input id="applicant_can_you_provide_document" type="radio" name="applicant_can_you_provide_document" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="applicant_can_you_provide_document" type="radio" name="applicant_can_you_provide_document" class="required" value="No"/>No
</td>
</tr>
<tr>
<td colspan="4">*Are you at least 18 years of age? </td><td colspan="2"><input id="applicant_are_you_atleast_18" type="radio" name="applicant_are_you_atleast_18" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="applicant_are_you_atleast_18" type="radio" name="applicant_are_you_atleast_18" value="No" class="required"/>No
</td>
</tr>
<tr>
<td colspan="4">*If you are under 18, and it is required, can you furnish a work permit?</td>
<td colspan="2"><input id="applicant_can_you_furnish_work_permit" type="radio" name="applicant_can_you_furnish_work_permit" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="applicant_can_you_furnish_work_permit" type="radio" name="applicant_can_you_furnish_work_permit" value="No" class="required"/>No
</td>
</tr>
<tr>
<td colspan="4">*Do you have a valid Driver's License? </td>
<td colspan="2"><input id="applicant_do_you_have_driver_license" type="radio" name="applicant_do_you_have_driver_license" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="applicant_do_you_have_driver_license" type="radio" name="applicant_do_you_have_driver_license" value="No" class="required"/>No
</td>
</tr>
<tr>
<td colspan="6">How were you referred Salmon Falls Nursery? <input id="applicant_how_were_you_referred_nursery" type="text" name="applicant_how_were_you_referred_nursery"  style="width:510px;" /></td>

</tr>
<tr>
<td colspan="4">*Have you ever been convicted of, or pled guilty or no contest to, a crime other than a minor traffic violation? </td>
<td colspan="2"><input id="applicant_have_you_ever_been_convicted_of" type="radio" name="applicant_have_you_ever_been_convicted_of" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="applicant_have_you_ever_been_convicted_of" type="radio" name="applicant_have_you_ever_been_convicted_of" value="No" class="required"/>No
</td>
</tr>
</tbody>
</table>
<table style="margin-top: 20px;" width="100%" cellspacing="10" cellpadding="5">
<tbody>
<tr>
<td colspan="4"><strong>EDUCATION:</strong></td>
</tr>
<tr><td colspan="5">High School or last grade completed: <input id="high_school_completed" type="text" name="high_school_completed" style="width: 300px;"/></td></tr>
<tr>
<td width="25%" >Name & Address of School:	</td><td width="11%" colspan="4"><div class="er"><input id="school_name_address" type="text" name="school_name_address" style="width: 411px;"/></div></td>
</tr>
<tr>
<td width="25%">Course Study: </td><td width="11%"><input id="education_course_of_study_school" type="text" name="education_course_of_study_school" style="width: 100px;" /></td>
<td width="31%">Last grade completed: </td><td width="11%">
<input id="education_last_grade_completed_school" type="text" name="education_last_grade_completed_school" style="width: 100px;" />
</td>
<td width="11%">Degree/Diploma: </td><td width="11%"><input id="education_degree_diploma_school" type="text" name="education_degree_diploma_school" style="width: 100px;"/></td>
</tr>
<tr><td colspan="5">College or Technical School: <input id="college_technical_school" type="text" name="college_technical_school" style="width: 357px;"/></td></tr>
<tr>
<td width="25%" >Name & Address of School:	</td><td width="11%" colspan="4"><div class="er"><input id="college_name_address" type="text" name="college_name_address" style="width: 411px;" /></div></td>
</tr>
<tr>
<td width="25%">Course Study: </td><td width="11%"><input id="education_course_of_study_college" type="text" name="education_course_of_study_college" style="width: 100px;" /></td>
<td width="31%">Last grade completed:</td><td width="11%">
<input id="education_last_grade_completed_college" type="text" name="education_last_grade_completed_college" style="width: 100px;" />
</td>
<td width="11%">Degree/Diploma: </td><td width="11%"><input id="education_degree_diploma_college" type="text" name="education_degree_diploma_college" style="width: 100px;"/></td>
</tr>
<tr><td colspan="5">Other Schooling or Training: <input id="other_schooling_training" type="text" name="other_schooling_training" style="width: 359px;"/></td></tr>
<tr>
<td width="25%" >Name & Address of School:	</td><td width="11%" colspan="4"><div class="er"><input id="other_name_address" type="text" name="other_name_address"  style="width: 411px;"/></div></td>
</tr>
<tr>
<td width="25%">Course Study: </td><td width="11%"><input id="education_course_of_study_other" type="text" name="education_course_of_study_other" style="width: 100px;" /></td>
<td width="31%">Last grade completed:</td><td width="11%">
<input id="education_last_grade_completed_other" type="text" name="education_last_grade_completed_other" style="width: 100px;" />
</td>
<td width="11%">Degree/Diploma: </td><td width="11%"><input id="education_degree_diploma_other" type="text" name="education_degree_diploma_other" style="width: 100px;"/></td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 0;" width="100%" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2"><strong>SPECIAL SKILS AND CERFICATIONS:</strong></td>
</tr>
<tr>
<td colspan="2">Summarize any training, skills, licenses and / or certificates that may qualify you as being able to perform job-related functions in the position for which you are applying: 
</td>
</tr>
<tr>
<td colspan="2">
<textarea id="special_skills_summarize_any_training" name="special_skills_summarize_any_training"  rows="4"  style="vertical-align:top; width:830px;"></textarea>
</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="4"><strong>MILITARY EXPERIENCE:</strong></td>
</tr>
<tr>
<td width="11%">Branch of Service:</td>
<td width="34%">
<input id="military_branch_of_service" type="text" name="military_branch_of_service" style="width:240px;" />
</td>
<td width="23%">Rank/Type of Service:</td>
<td width="32%">
<input id="military_rank_of_service" type="text" name="military_rank_of_service" style="width:240px;" />
</td>
</tr>

<tr>
<td>Job-Related Training/Experience: </td>
<td colspan="3">
<textarea id="military_job_related_training" name="military_job_related_training" rows="4" style="vertical-align:top; width:676px;"></textarea>
</td>
</tr>
</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>RECORD OF EMPLOYMENT: </strong>List positions starting with most recent</td>
</tr>
</tbody>
</table>
<table style="margin-top: 10px;" cellpadding="5" cellspacing="0">
<tbody>
<tr>
<td width="13%">Employer: </td><td colspan="3"><input id="record_employer" type="text" name="record_employer" style="width:295px;" /></td>
<td width="10%">Telephone:</td><td colspan="3">
<input id="record_telephone" type="text" name="record_telephone" style="width:295px;" />
</td>
</tr>
<tr>
<td width="13%">Address: </td><td colspan="7"><input id="record_address" type="text" name="record_address" style="width:295px;"/></td>
<td></td>
</tr>
<tr>
<td width="13%">Position Title: </td><td width="14%"><input id="record_position_title" type="text" name="record_position_title" /></td>
<td>Supervisor name/email/phone: </td><td colspan="5">
<input id="record_supervisor_name" type="text" name="record_supervisor_name" style="width:394px;" />
</td>
</tr>
<tr>
<td width="13%">Start Date: </td><td width="14%"><input id="record_start_date" type="text" name="record_start_date" /></td>
<td width="10%">Date Left:</td><td width="14%">
<input id="record_date_left" type="text" name="record_date_left" />
</td>
<td width="10%">Beginning Salary:</td><td width="10%">
<input id="record_beginning_salary" type="text" name="record_beginning_salary" />
</td>
<td width="12%">Ending Salary:</td><td width="17%">
<input id="record_ending_salary" type="text" name="record_ending_salary" />
</td>
</tr>
<tr>
<td width="13%">Duties: </td><td colspan="7"><input id="record_duties" type="text" name="record_duties" style="width: 606px;"/></td>

</tr>
<tr>
<td width="13%">Reason for Leaving: </td><td colspan="7"><input id="record_reason_for_leaving" type="text" name="record_reason_for_leaving" style="width: 606px;" /></td>

</tr>
<tr>
<td colspan="5">Where you subject to FMCSR while working for this company? </td>
<td><input id="record_where_you_subject_to" type="radio" name="record_where_you_subject_to" value="Yes"/>Yes&nbsp;&nbsp;
<input id="record_where_you_subject_to" type="radio" name="record_where_you_subject_to" value="No"/>No
</td>
</tr>
<tr>
<td colspan="5">Was your job with this company designated as a safety sensitive function subject to drug and alcohol testing requirements of 49 CFR </td>
<td><input id="record_was_your_job_with_this_company" type="radio" name="record_was_your_job_with_this_company" value="Yes"/>Yes&nbsp;&nbsp;
<input id="record_was_your_job_with_this_company" type="radio" name="record_was_your_job_with_this_company" value="No"/>No
</td>
</tr>

</tbody>
</table>

<table style="margin-top: 10px;" cellpadding="5" cellspacing="0">
<tbody>
<tr>
<td width="13%">Employer: </td><td colspan="3"><input id="record_employer2" type="text" name="record_employer2" style="width:295px;" /></td>
<td width="10%">Telephone:</td><td colspan="3">
<input id="record_telephone2" type="text" name="record_telephone2" style="width:295px;" />
</td>
</tr>
<tr>
<td width="13%">Address: </td><td colspan="7"><input id="record_address2" type="text" name="record_address2" style="width:295px;"/></td>
<td></td>
</tr>
<tr>
<td width="13%">Position Title: </td><td width="14%"><input id="record_position_title2" type="text" name="record_position_title2" /></td>
<td>Supervisor name/email/phone: </td><td colspan="5">
<input id="record_supervisor_name2" type="text" name="record_supervisor_name2" style="width:394px;" />
</td>
</tr>
<tr>
<td width="13%">Start Date: </td><td width="14%"><input id="record_start_date2" type="text" name="record_start_date2" /></td>
<td width="10%">Date Left:</td><td width="14%">
<input id="record_date_left2" type="text" name="record_date_left2" />
</td>
<td width="10%">Beginning Salary:</td><td width="10%">
<input id="record_beginning_salary2" type="text" name="record_beginning_salary2" />
</td>
<td width="12%">Ending Salary:</td><td width="17%">
<input id="record_ending_salary2" type="text" name="record_ending_salary2" />
</td>
</tr>
<tr>
<td width="13%">Duties: </td><td colspan="7"><input id="record_duties2" type="text" name="record_duties2" style="width: 606px;"/></td>

</tr>
<tr>
<td width="13%">Reason for Leaving: </td><td colspan="7"><input id="record_reason_for_leaving2" type="text" name="record_reason_for_leaving2" style="width: 606px;" /></td>

</tr>
<tr>
<td colspan="5">Where you subject to FMCSR while working for this company? </td>
<td><input id="record_where_you_subject_to2" type="radio" name="record_where_you_subject_to2" value="Yes"/>Yes&nbsp;&nbsp;
<input id="record_where_you_subject_to2" type="radio" name="record_where_you_subject_to2" value="No"/>No
</td>
</tr>
<tr>
<td colspan="5">Was your job with this company designated as a safety sensitive function subject to drug and alcohol testing requirements of 49 CFR </td>
<td><input id="record_was_your_job_with_this_company2" type="radio" name="record_was_your_job_with_this_company2" value="Yes"/>Yes&nbsp;&nbsp;
<input id="record_was_your_job_with_this_company2" type="radio" name="record_was_your_job_with_this_company2" value="No"/>No
</td>
</tr>

</tbody>
</table>

<table style="margin-top: 10px;" cellpadding="5" cellspacing="0">
<tbody>
<tr>
<td width="13%">Employer: </td><td colspan="3"><input id="record_employer3" type="text" name="record_employer3" style="width:295px;" /></td>
<td width="10%">Telephone:</td><td colspan="3">
<input id="record_telephone3" type="text" name="record_telephone3" style="width:295px;" />
</td>
</tr>
<tr>
<td width="13%">Address: </td><td colspan="7"><input id="record_address3" type="text" name="record_address3" style="width:295px;"/></td>
<td></td>
</tr>
<tr>
<td width="13%">Position Title: </td><td width="14%"><input id="record_position_title3" type="text" name="record_position_title3" /></td>
<td>Supervisor name/email/phone: </td><td colspan="5">
<input id="record_supervisor_name3" type="text" name="record_supervisor_name3" style="width:394px;" />
</td>
</tr>
<tr>
<td width="13%">Start Date: </td><td width="14%"><input id="record_start_date3" type="text" name="record_start_date3" /></td>
<td width="10%">Date Left:</td><td width="14%">
<input id="record_date_left3" type="text" name="record_date_left3" />
</td>
<td width="10%">Beginning Salary:</td><td width="10%">
<input id="record_beginning_salary3" type="text" name="record_beginning_salary3" />
</td>
<td width="12%">Ending Salary:</td><td width="17%">
<input id="record_ending_salary3" type="text" name="record_ending_salary3" />
</td>
</tr>
<tr>
<td width="13%">Duties: </td><td colspan="7"><input id="record_duties3" type="text" name="record_duties3" style="width: 606px;"/></td>

</tr>
<tr>
<td width="13%">Reason for Leaving: </td><td colspan="7"><input id="record_reason_for_leaving3" type="text" name="record_reason_for_leaving3" style="width: 606px;" /></td>

</tr>
<tr>
<td colspan="5">Where you subject to FMCSR while working for this company? </td>
<td><input id="record_where_you_subject_to3" type="radio" name="record_where_you_subject_to3" value="Yes"/>Yes&nbsp;&nbsp;
<input id="record_where_you_subject_to3" type="radio" name="record_where_you_subject_to3" value="No"/>No
</td>
</tr>
<tr>
<td colspan="5">Was your job with this company designated as a safety sensitive function subject to drug and alcohol testing requirements of 49 CFR </td>
<td><input id="record_was_your_job_with_this_company3" type="radio" name="record_was_your_job_with_this_company3" value="Yes"/>Yes&nbsp;&nbsp;
<input id="record_was_your_job_with_this_company3" type="radio" name="record_was_your_job_with_this_company3" value="No"/>No
</td>
</tr>

</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Driver-Experience and Qualification (to be completed only if applying for driving position)</strong></td>
</tr>
<tr>
<td colspan="2">(Complete if you have driven a company vehicle subjected to FMCSR- Federal Motor Carrier Safety Administration)</td>
</tr>
</tbody>
</table>
<table width="100%" style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12%" rowspan="4" style="border-right:1px solid #444;border-bottom:1px solid #444;"><p align="center">Drivers Licenses</p>
</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">State</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">License #</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Type</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Expiration Date</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_state1" id="license_state1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_number1" id="license_number1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_type1" id="license_type1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_expiration_date1" id="license_expiration_date1" /></td>
  </tr>
   <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_state2" id="license_state2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_number2" id="license_number2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_type2" id="license_type2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_expiration_date2" id="license_expiration_date2" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_state3" id="license_state3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_number3" id="license_number3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_type3" id="license_type3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="license_expiration_date3" id="license_expiration_date3" /></td>
  </tr>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Driving Experience</strong></td>
</tr>
</tbody>
</table>
<table width="100%" style="border-left:1px solid #444;border-top:1px solid #444;border-right:1px solid #444;border-bottom:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Class of Equipment</td>
    <td width="24%" style="border-right:1px solid #444;border-bottom:1px solid #444;"><p style="text-align:center;">Type of Equipment<br />(Van, Tank, Flat, Etc.)</p></td>
    <td colspan="2" style="border-right:1px solid #444;border-bottom:1px solid #444;"><p style="text-align:center;">Dates<br />
From                                               To</p></td>
    <td width="33%" style="border-right:1px solid #444;border-bottom:1px solid #444;">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Straight Truck</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="type_of_equipment1" id="type_of_equipment1" /></td>
    <td width="13%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="from_date1" id="from_date1" /></td>
    <td width="13%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="to_date1" id="to_date1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="other1" id="other1" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Tractor &amp; Semi-Tractor</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="type_of_equipment2" id="type_of_equipment2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="from_date2" id="from_date2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="to_date2" id="to_date2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="other2" id="other2" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Tractor Two Trailers</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="type_of_equipment3" id="type_of_equipment3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="from_date3" id="from_date3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="to_date3" id="to_date3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="other3" id="other3" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Other</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="type_of_equipment4" id="type_of_equipment4" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="from_date4" id="from_date4" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="to_date4" id="to_date4" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="other4" id="other4" /></td>
  </tr>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Accident record for the past 3 years or more (attach sheet if more space is needed)</strong></td>
</tr>
</tbody>
</table>
<table width="100%" style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Dates</td>
    <td width="39%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Nature of accident (head-on, rear-end, upset,  etc.)</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Fatalities</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Injuries</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Last Accident</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="nature_of_accident1" id="nature_of_accident1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="fatalities1" id="fatalities1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="injuries1" id="injuries1" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Previous</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="nature_of_accident2" id="nature_of_accident2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="fatalities2" id="fatalities2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="injuries2" id="injuries2" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Previous</td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="nature_of_accident3" id="nature_of_accident3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="fatalities3" id="fatalities3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="injuries3" id="injuries3" /></td>
  </tr>
</table>
<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2"><strong>Traffic convictions and forfeitures for the past 3 years (other than parking violations)</strong></td>
</tr>
</tbody>
</table>
<table width="100%" style="border-left:1px solid #444;border-top:1px solid #444;" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Location</td>
    <td width="39%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Date</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Charge</td>
    <td width="22%" style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;">Penalty</td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_location1" id="traffic_location1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_date1" id="traffic_date1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_charge1" id="traffic_charge1" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_penalty1" id="traffic_penalty1" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_location2" id="traffic_location2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_date2" id="traffic_date2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_charge2" id="traffic_charge2" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_penalty2" id="traffic_penalty2" /></td>
  </tr>
  <tr>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_location3" id="traffic_location3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_date3" id="traffic_date3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_charge3" id="traffic_charge3" /></td>
    <td style="text-align:center;border-right:1px solid #444;border-bottom:1px solid #444;"><input type="text" name="traffic_penalty3" id="traffic_penalty3" /></td>
  </tr>
</table>
<table width="100%">
<tbody>
<tr>
<td colspan="2" style="text-align:center;">(Attach sheet if more space is needed)</td>
</tr>
</tbody>
</table>

<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="69%">*Have you ever been denied a license, permit or privilege to operate a motor vehicle? </td>
<td width="31%"><input id="have_you_ever_been_denied_a_license" type="radio" name="have_you_ever_been_denied_a_license" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="have_you_ever_been_denied_a_license" type="radio" name="have_you_ever_been_denied_a_license" value="No" class="required"/>No
</td>
</tr>

<tr>
<td>*Have any license, permit or privilege ever been suspended or revoked? </td>
<td><input id="have_any_license_permit" type="radio" name="have_any_license_permit" value="Yes" class="required"/>Yes&nbsp;&nbsp;
<input id="have_any_license_permit" type="radio" name="have_any_license_permit" value="No" class="required"/>No
</td>
</tr>
</tbody>
</table>

<table style="margin-top: 10px; padding: 10px;" width="100%">
<tbody>
<tr>
<td colspan="2" style="text-align:center;"><strong>Driver Applicants</strong></td>
</tr>
<tr>
<td colspan="2">Please understand that information you provide regarding, current and previous employers may be used and those employers will be contacted for the purpose of investigating your safety performance history as required by 49 CFR 391.23 (d) and (e).  </td>
</tr>
</tbody>
</table>

<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td width="15%">*Applicant Name : </td>
<td width="36%"> <div class="er"><input id="applicant_signature" type="text" name="applicant_signature" style="width:250px;" class="required"/></div></td>
<td width="8%" >*Date :</td>
<td width="41%"><div class="er"> <input id="applicant_date" type="text" name="applicant_date" style="width:250px;" class="required"/></div></td>
</tr>

</tbody>
</table>

<table style="padding: 10px;" width="100%">
<tbody>
<tr>
<td style="border-bottom: 1px solid #000; width: 100%;padding: 3px;" colspan="4"></td>
</tr>
<tr>
<td colspan="4" style="text-align: center;">
<input id="submit" style="font-size: 21px; height: 40px; width: 132px;" type="submit" name="submit" value="Submit" />
</td>
</tr>
</tbody>
</table>
</form>
</div>

<?php } ?>
</div>
<?php 
get_footer();
?>
