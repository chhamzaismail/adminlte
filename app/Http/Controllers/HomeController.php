<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = DB::table('users')->get();
        $user_name = Auth::user()->name; 
        $students_count= DB::table('students')->count();
        $courses_count= DB::table('courses')->count();
        return view('Admin',compact('students_count', 'courses_count','user_name'));

        // echo '<pre>';
        // print_r($users_count);
        // echo '</pre>';

        // OR (By using helper function)

        p($students_count);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function simah(){
        $response = $this->get_sample_simah_response();
        $response_array = (array)simplexml_load_string($response);
        if(isset($response_array['IsSuccess']) && $response_array['IsSuccess']==true){
            $simah_core_data = array();
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->ReportDate)){
                $REPORT_DATE = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->ReportDetails->ReportDate);
                $simah_core_data['ReportDate'] = date('Y-m-d',strtotime($REPORT_DATE));    
            }
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->EnquiryType)){
                $simah_core_data['EnquiryType'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->EnquiryType;
            }
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->ProductType)){
                $simah_core_data['ProductType'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->ProductType;
            }
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->EnquiryNumber)){
                $simah_core_data['EnquiryNumber'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->EnquiryNumber;
            } 
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->NumberOfApplicants)){
                $simah_core_data['NumberOfApplicants'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->NumberOfApplicants;
            } 
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->AccountType)){
                $simah_core_data['AccountType'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->AccountType;
            }   
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->ReferenceNumber)){
                $simah_core_data['ReferenceNumber'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->ReferenceNumber;
            }
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->Amount)){
                $simah_core_data['Amount'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->Amount;
            }  
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->MemberType->Id)){
                $simah_core_data['MemberType_Id'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->MemberType->Id;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->MemberType->Code)){
                $simah_core_data['MemberType_Code'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->MemberType->Code;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->MemberType->NameAr)){
                $simah_core_data['MemberType_NameAr'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->MemberType->NameAr;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->MemberType->Name)){
                $simah_core_data['MemberType_Name'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->MemberType->Name;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->Status->Id)){
                $simah_core_data['Status_Id'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->Status->Id;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->Status->Code)){
                $simah_core_data['Status_Code'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->Status->Code;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->Status->NameAr)){
                $simah_core_data['Status_NameAr'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->Status->NameAr;
            }          
            if(isset($response_array['Data']->ApplicationResponse->ReportDetails->Status->Name)){
                $simah_core_data['Status_Name'] = (string)$response_array['Data']->ApplicationResponse->ReportDetails->Status->Name;
            }

            // Provided
            $simah_consumer_provided_demographic_info = array();  
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDNumber)){
                $simah_consumer_provided_demographic_info['DemIDNumber'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDNumber; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->TypeID)){
                $simah_consumer_provided_demographic_info['DemIDType_TypeID'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->TypeID; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->TypeNameEN)){
                $simah_consumer_provided_demographic_info['DemIDType_TypeNameEN'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->TypeNameEN; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->TypeNameAR)){
                $simah_consumer_provided_demographic_info['DemIDType_TypeNameAR'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->TypeNameAR; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->IDTypeCode)){
                $simah_consumer_provided_demographic_info['DemIDType_IDTypeCode'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDType->IDTypeCode; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDExpiryDate)){
                $DemIDExpiryDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemIDExpiryDate);
                $simah_consumer_provided_demographic_info['DemIDExpiryDate'] = date('Y-m-d',strtotime($DemIDExpiryDate)); 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeID)){
                $simah_consumer_provided_demographic_info['DemApplicantType_ApplicantTypeID'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeID; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeCode)){
                $simah_consumer_provided_demographic_info['DemApplicantType_ApplicantTypeCode'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeCode; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeNameEN)){
                $simah_consumer_provided_demographic_info['DemApplicantType_ApplicantTypeNameEN'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeNameEN; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeNameAR)){
                $simah_consumer_provided_demographic_info['DemApplicantType_ApplicantTypeNameAR'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemApplicantType->ApplicantTypeNameAR; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemCustomerName)){
                $simah_consumer_provided_demographic_info['DemCustomerName'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemCustomerName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFamilyName)){
                $simah_consumer_provided_demographic_info['DemFamilyName'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFamilyName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFirstName)){
                $simah_consumer_provided_demographic_info['DemFirstName'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFirstName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemSecondName)){
                $simah_consumer_provided_demographic_info['DemSecondName'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemSecondName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemThirdName)){
                $simah_consumer_provided_demographic_info['DemThirdName'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemThirdName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemCustomerNameAr)){
                $simah_consumer_provided_demographic_info['DemCustomerNameAr'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemCustomerNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFamilyNameAr)){
                $simah_consumer_provided_demographic_info['DemFamilyNameAr'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFamilyNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFirstNameAr)){
                $simah_consumer_provided_demographic_info['DemFirstNameAr'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemFirstNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemSecondNameAr)){
                $simah_consumer_provided_demographic_info['DemSecondNameAr'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemSecondNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemThirdNameAr)){
                $simah_consumer_provided_demographic_info['DemThirdNameAr'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemThirdNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemDateOfBirth)){
                $DemDateOfBirth = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemDateOfBirth);
                $simah_consumer_provided_demographic_info['DemDateOfBirth'] = date('Y-m-d',strtotime($DemDateOfBirth)); 
            } 
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemGender)){
                $simah_consumer_provided_demographic_info['DemGender'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemGender;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->MatrialStatusId)){
                $simah_consumer_provided_demographic_info['DemMaritalStatus_MatrialStatusId'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->MatrialStatusId;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->StatusNameEN)){
                $simah_consumer_provided_demographic_info['DemMaritalStatus_StatusNameEN'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->StatusNameEN;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->StatusNameAR)){
                $simah_consumer_provided_demographic_info['DemMaritalStatus_StatusNameAR'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->StatusNameAR;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->MaritalStatusCode)){
                $simah_consumer_provided_demographic_info['DemMaritalStatus_MaritalStatusCode'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemMaritalStatus->MaritalStatusCode;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemNationality->COUID)){
                $simah_consumer_provided_demographic_info['DemNationality_COUID'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemNationality->COUID;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemNationality->CouNameEN)){
                $simah_consumer_provided_demographic_info['DemNationality_CouNameEN'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemNationality->CouNameEN;
            }       
            if(isset($response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemNationality->CouNameAR)){
                $simah_consumer_provided_demographic_info['DemNationality_CouNameAR'] = (string)$response_array['Data']->ApplicationResponse->ProvidedDemographicsInfo->DemNationality->CouNameAR;
            }     
            //  available_demographic_info
            $simah_conumer_available_demographic_info = array();  
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDNumber)){
                $simah_conumer_available_demographic_info['DemIDNumber'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDNumber; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->TypeID)){
                $simah_conumer_available_demographic_info['DemIDType_TypeID'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->TypeID; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->TypeNameEN)){
                $simah_conumer_available_demographic_info['DemIDType_TypeNameEN'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->TypeNameEN; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->TypeNameAR)){
                $simah_conumer_available_demographic_info['DemIDType_TypeNameAR'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->TypeNameAR; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->IDTypeCode)){
                $simah_conumer_available_demographic_info['DemIDType_IDTypeCode'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDType->IDTypeCode; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDExpiryDate)){
                $DemIDExpiryDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemIDExpiryDate);
                $simah_conumer_available_demographic_info['DemIDExpiryDate'] = date('Y-m-d',strtotime($DemIDExpiryDate)); 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeID)){
                $simah_conumer_available_demographic_info['DemApplicantType_ApplicantTypeID'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeID; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeCode)){
                $simah_conumer_available_demographic_info['DemApplicantType_ApplicantTypeCode'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeCode; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeNameEN)){
                $simah_conumer_available_demographic_info['DemApplicantType_ApplicantTypeNameEN'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeNameEN; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeNameAR)){
                $simah_conumer_available_demographic_info['DemApplicantType_ApplicantTypeNameAR'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemApplicantType->ApplicantTypeNameAR; 
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemCustomerName)){
                $simah_conumer_available_demographic_info['DemCustomerName'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemCustomerName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFamilyName)){
                $simah_conumer_available_demographic_info['DemFamilyName'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFamilyName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFirstName)){
                $simah_conumer_available_demographic_info['DemFirstName'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFirstName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemSecondName)){
                $simah_conumer_available_demographic_info['DemSecondName'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemSecondName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemThirdName)){
                $simah_conumer_available_demographic_info['DemThirdName'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemThirdName;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemCustomerNameAr)){
                $simah_conumer_available_demographic_info['DemCustomerNameAr'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemCustomerNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFamilyNameAr)){
                $simah_conumer_available_demographic_info['DemFamilyNameAr'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFamilyNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFirstNameAr)){
                $simah_conumer_available_demographic_info['DemFirstNameAr'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemFirstNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemSecondNameAr)){
                $simah_conumer_available_demographic_info['DemSecondNameAr'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemSecondNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemThirdNameAr)){
                $simah_conumer_available_demographic_info['DemThirdNameAr'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemThirdNameAr;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemDateOfBirth)){
                $DemDateOfBirth = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemDateOfBirth);
                $simah_conumer_available_demographic_info['DemDateOfBirth'] = date('Y-m-d',strtotime($DemDateOfBirth)); 
            } 
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemGender)){
                $simah_conumer_available_demographic_info['DemGender'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemGender;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->MatrialStatusId)){
                $simah_conumer_available_demographic_info['DemMaritalStatus_MatrialStatusId'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->MatrialStatusId;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->StatusNameEN)){
                $simah_conumer_available_demographic_info['DemMaritalStatus_StatusNameEN'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->StatusNameEN;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->StatusNameAR)){
                $simah_conumer_available_demographic_info['DemMaritalStatus_StatusNameAR'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->StatusNameAR;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->MaritalStatusCode)){
                $simah_conumer_available_demographic_info['DemMaritalStatus_MaritalStatusCode'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemMaritalStatus->MaritalStatusCode;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemNationality->COUID)){
                $simah_conumer_available_demographic_info['DemNationality_COUID'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemNationality->COUID;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemNationality->CouNameEN)){
                $simah_conumer_available_demographic_info['DemNationality_CouNameEN'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemNationality->CouNameEN;
            }       
            if(isset($response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemNationality->CouNameAR)){
                $simah_conumer_available_demographic_info['DemNationality_CouNameAR'] = (string)$response_array['Data']->ApplicationResponse->AvailableDemographicsInfo->DemNationality->CouNameAR;
            }
             
            // Previous enquiries
            if(isset($response_array['Data']->ApplicationResponse->PrevEnquiries->PrevEnquiryView)){
                foreach($response_array['Data']->ApplicationResponse->PrevEnquiries->PrevEnquiryView as $prev_enquiry){
                    $simah_consumer_previous_enquiries_data = array(); 
                    if(isset($prev_enquiry->PrevEnqDate)){
                        $PrevEnqDate = str_replace("/","-",(string)$prev_enquiry->PrevEnqDate);
                        $simah_consumer_previous_enquiries_data['PrevEnqDate'] =  date('Y-m-d',strtotime($PrevEnqDate)); 
                    } 
                    if(isset($prev_enquiry->PreEnqType->EnqTypeCode)){
                        $simah_consumer_previous_enquiries_data['PreEnqType_EnqTypeCode'] = (string)$prev_enquiry->PreEnqType->EnqTypeCode; 
                    } 
                    if(isset($prev_enquiry->PreEnqType->EnqTypeDescriptionAr)){
                        $simah_consumer_previous_enquiries_data['PreEnqType_EnqTypeDescriptionAr'] = (string)$prev_enquiry->PreEnqType->EnqTypeDescriptionAr; 
                    } 
                    if(isset($prev_enquiry->PreEnqType->EnqTypeDescriptionEn)){
                        $simah_consumer_previous_enquiries_data['PreEnqType_EnqTypeDescriptionEn'] = (string)$prev_enquiry->PreEnqType->EnqTypeDescriptionEn; 
                    } 
                    if(isset($prev_enquiry->PrevEnqEnquirer->MemberCode)){
                        $simah_consumer_previous_enquiries_data['PrevEnqEnquirer_MemberCode'] = (string)$prev_enquiry->PrevEnqEnquirer->MemberCode; 
                    } 
                    if(isset($prev_enquiry->PrevEnqEnquirer->MemberNameEN)){
                        $simah_consumer_previous_enquiries_data['PrevEnqEnquirer_MemberNameEN'] = (string)$prev_enquiry->PrevEnqEnquirer->MemberNameEN; 
                    } 
                    if(isset($prev_enquiry->PrevEnqEnquirer->MemberNameAR)){
                        $simah_consumer_previous_enquiries_data['PrevEnqEnquirer_MemberNameAR'] = (string)$prev_enquiry->PrevEnqEnquirer->MemberNameAR; 
                    } 
                    if(isset($prev_enquiry->PrevEnqMemberRef)){
                        $simah_consumer_previous_enquiries_data['PrevEnqMemberRef'] = (string)$prev_enquiry->PrevEnqMemberRef; 
                    } 
                    if(isset($prev_enquiry->PrevEnquirerName)){
                        $simah_consumer_previous_enquiries_data['PrevEnquirerName'] = (string)$prev_enquiry->PrevEnquirerName; 
                    } 
                    if(isset($prev_enquiry->PrevEnquirerNameAr)){
                        $simah_consumer_previous_enquiries_data['PrevEnquirerNameAr'] = (string)$prev_enquiry->PrevEnquirerNameAr; 
                    } 
                    if(isset($prev_enquiry->PrevEnqProductTypeDesc->ProductId)){
                        $simah_consumer_previous_enquiries_data['PrevEnqProductTypeDesc->ProductId'] = (string)$prev_enquiry->PrevEnqProductTypeDesc->ProductId; 
                    } 
                    if(isset($prev_enquiry->PrevEnqProductTypeDesc->Code)){
                        $simah_consumer_previous_enquiries_data['PrevEnqProductTypeDesc->Code'] = (string)$prev_enquiry->PrevEnqProductTypeDesc->Code; 
                    } 
                    if(isset($prev_enquiry->PrevEnqProductTypeDesc->TextEn)){
                        $simah_consumer_previous_enquiries_data['PrevEnqProductTypeDesc->TextEn'] = (string)$prev_enquiry->PrevEnqProductTypeDesc->TextEn; 
                    } 
                    if(isset($prev_enquiry->PrevEnqProductTypeDesc->TextAr)){
                        $simah_consumer_previous_enquiries_data['PrevEnqProductTypeDesc->TextAr'] = (string)$prev_enquiry->PrevEnqProductTypeDesc->TextAr; 
                    } 
                    if(isset($prev_enquiry->PrevEnqAmount)){
                        $simah_consumer_previous_enquiries_data['PrevEnqAmount'] = (string)$prev_enquiry->PrevEnqAmount; 
                    } 
                } 
            }
            // Credit Instrument Details
            $simah_consumer_ci_data = array();  
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CICreditor->MemberCode)){
                $simah_consumer_ci_data['CICreditor_MemberCode'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CICreditor->MemberCode; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CICreditor->MemberNameEN)){
                $simah_consumer_ci_data['CICreditor_MemberNameEN'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CICreditor->MemberNameEN; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CICreditor->MemberNameAR)){
                $simah_consumer_ci_data['CICreditor_MemberNameAR'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CICreditor->MemberNameAR; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->ProductId)){
                $simah_consumer_ci_data['CIProductTypeDesc_ProductId'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->ProductId; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->Code)){
                $simah_consumer_ci_data['CIProductTypeDesc_Code'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->Code; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->TextEn)){
                $simah_consumer_ci_data['CIProductTypeDesc_TextEn'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->TextEn; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->TextAr)){
                $simah_consumer_ci_data['CIProductTypeDesc_TextAr'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIProductTypeDesc->TextAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIAccountNumber)){
                $simah_consumer_ci_data['CIAccountNumber'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIAccountNumber; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CILimit)){
                $simah_consumer_ci_data['CILimit'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CILimit; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIIssuedDate)){
                $CIIssuedDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIIssuedDate);
                $simah_consumer_ci_data['CIIssuedDate'] = date('Y-m-d',strtotime($CIIssuedDate)); 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIExpirationDate)){
                $CIExpirationDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIExpirationDate);
                $simah_consumer_ci_data['CIExpirationDate'] = date('Y-m-d',strtotime($CIExpirationDate)); 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIStatus->CreditInstrumentStatusCode)){
                $simah_consumer_ci_data['CIStatus_CreditInstrumentStatusCode'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIStatus->CreditInstrumentStatusCode; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIStatus->CreditInstrumentStatusDescAr)){
                $simah_consumer_ci_data['CIStatus_CreditInstrumentStatusDescAr'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIStatus->CreditInstrumentStatusDescAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIStatus->CreditInstrumentStatusDescEn)){
                $simah_consumer_ci_data['CIStatus_CreditInstrumentStatusDescEn'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIStatus->CreditInstrumentStatusDescEn; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CITenure)){
                $simah_consumer_ci_data['CITenure'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CITenure; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPaymentFrequency->PaymentFrequencyCodeDescEn)){
                $simah_consumer_ci_data['CIPaymentFrequency_PaymentFrequencyCodeDescEn'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPaymentFrequency->PaymentFrequencyCodeDescEn; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPaymentFrequency->PaymentFrequencyCodeDescAr)){
                $simah_consumer_ci_data['CIPaymentFrequency_PaymentFrequencyCodeDescAr'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPaymentFrequency->PaymentFrequencyCodeDescAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPaymentFrequency->PaymentFrequencyCodeName)){
                $simah_consumer_ci_data['CIPaymentFrequency_PaymentFrequencyCodeName'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPaymentFrequency->PaymentFrequencyCodeName; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIInstallmentAmount)){
                $simah_consumer_ci_data['CIInstallmentAmount'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIInstallmentAmount; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISalaryAssignmentFlag->SalaryAssignmentFlagDescEn)){
                $simah_consumer_ci_data['CISalaryAssignmentFlag->SalaryAssignmentFlagDescEn'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISalaryAssignmentFlag->SalaryAssignmentFlagDescEn; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISalaryAssignmentFlag->SalaryAssignmentFlagDescAr)){
                $simah_consumer_ci_data['CISalaryAssignmentFlag->SalaryAssignmentFlagDescAr'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISalaryAssignmentFlag->SalaryAssignmentFlagDescAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISalaryAssignmentFlag->SalaryAssignmentFlagCode)){
                $simah_consumer_ci_data['CISalaryAssignmentFlag->SalaryAssignmentFlagCode'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISalaryAssignmentFlag->SalaryAssignmentFlagCode; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIConsumerSecurityType->ConsumerSecurityTypeDescEn)){
                $simah_consumer_ci_data['CIConsumerSecurityType->ConsumerSecurityTypeDescEn'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIConsumerSecurityType->ConsumerSecurityTypeDescEn; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIConsumerSecurityType->ConsumerSecurityTypeDescAr)){
                $simah_consumer_ci_data['CIConsumerSecurityType->ConsumerSecurityTypeDescAr'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIConsumerSecurityType->ConsumerSecurityTypeDescAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIConsumerSecurityType->ConsumerSecurityTypeCode)){
                $simah_consumer_ci_data['CIConsumerSecurityType->ConsumerSecurityTypeCode'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIConsumerSecurityType->ConsumerSecurityTypeCode; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIOutstandingBalance)){
                $simah_consumer_ci_data['CIOutstandingBalance'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIOutstandingBalance; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPastDue)){
                $simah_consumer_ci_data['CIPastDue'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIPastDue; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CILastAmountPaid)){
                $simah_consumer_ci_data['CILastAmountPaid'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CILastAmountPaid; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CILastPaymentDate)){
                $CILastPaymentDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CILastPaymentDate);
                $simah_consumer_ci_data['CILastPaymentDate'] = date('Y-m-d',strtotime($CILastPaymentDate)) ; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIAsOfDate)){
                $CIAsOfDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIAsOfDate);
                $simah_consumer_ci_data['CIAsOfDate'] = date('Y-m-d',strtotime($CIAsOfDate)) ; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CINextDueDate)){
                $CINextDueDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CINextDueDate);
                $simah_consumer_ci_data['CINextDueDate'] = date('Y-m-d',strtotime($CINextDueDate)) ; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISummary)){
                $simah_consumer_ci_data['CISummary'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CISummary; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIDownPayment)){
                $simah_consumer_ci_data['CIDownPayment'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIDownPayment; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIDispensedAmount)){
                $simah_consumer_ci_data['CIDispensedAmount'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIDispensedAmount; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIMaxInstalmentAmount)){
                $simah_consumer_ci_data['CIMaxInstalmentAmount'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIMaxInstalmentAmount; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->MultiInstalmentDetails)){
                $simah_consumer_ci_data['MultiInstalmentDetails'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->MultiInstalmentDetails; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIAverageInstallmentAmount)){
                $simah_consumer_ci_data['CIAverageInstallmentAmount'] = (string)$response_array['Data']->ApplicationResponse->CreditInstrumentDetails->CreditInstrumentDetailView->CIAverageInstallmentAmount; 
            } 
            // Bounced Cheques
            if(isset($response_array['Data']->ApplicationResponse->BouncedCheques->ConsumerBouncedChequeView)){
                foreach($response_array['Data']->ApplicationResponse->BouncedCheques->ConsumerBouncedChequeView as $cheques){
                    $simah_consumer_bounced_data = array();
                    if(isset($cheques->BCCheqDateLoaded)){
                        $BCCheqDateLoaded = str_replace("/","-",(string)$cheques->BCCheqDateLoaded);
                        $simah_consumer_bounced_data['BCCheqDateLoaded'] = date('Y-m-d',strtotime($BCCheqDateLoaded)) ; 
                    } 
                    if(isset($cheques->BCProductTypeDesc->ProductId)){
                        $simah_consumer_bounced_data['BCProductTypeDesc_ProductId'] = (string)$cheques->BCProductTypeDesc->ProductId; 
                    } 
                    if(isset($cheques->BCProductTypeDesc->Code)){
                        $simah_consumer_bounced_data['BCProductTypeDesc_Code'] = (string)$cheques->BCProductTypeDesc->Code; 
                    } 
                    if(isset($cheques->BCProductTypeDesc->TextEn)){
                        $simah_consumer_bounced_data['BCProductTypeDesc_TextEn'] = (string)$cheques->BCProductTypeDesc->TextEn; 
                    } 
                    if(isset($cheques->BCProductTypeDesc->TextAr)){
                        $simah_consumer_bounced_data['BCProductTypeDesc_TextAr'] = (string)$cheques->BCProductTypeDesc->TextAr; 
                    } 
                    if(isset($cheques->BCCreditor->MemberNameEN)){
                        $simah_consumer_bounced_data['BCCreditor_MemberNameEN'] = (string)$cheques->BCCreditor->MemberNameEN; 
                    } 
                    if(isset($cheques->BCCreditor->MemberNameAR)){
                        $simah_consumer_bounced_data['BCCreditor_MemberNameAR'] = (string)$cheques->BCCreditor->MemberNameAR; 
                    } 
                    if(isset($cheques->BCChequeNumber)){
                        $simah_consumer_bounced_data['BCChequeNumber'] = (string)$cheques->BCChequeNumber; 
                    } 
                    if(isset($cheques->BCBalance)){
                        $simah_consumer_bounced_data['BCBalance'] = (string)$cheques->BCBalance; 
                    } 
                    if(isset($cheques->BCOutstandingBalance)){
                        $simah_consumer_bounced_data['BCOutstandingBalance'] = (string)$cheques->BCOutstandingBalance; 
                    } 
                    if(isset($cheques->BCDefaultStatuses->DefaultStatusDescEn)){
                        $simah_consumer_bounced_data['BCDefaultStatuses_DefaultStatusDescEn'] = (string)$cheques->BCDefaultStatuses->DefaultStatusDescEn; 
                    } 
                    if(isset($cheques->BCDefaultStatuses->DefaultStatusDescAr)){
                        $simah_consumer_bounced_data['BCDefaultStatuses_DefaultStatusDescAr'] = (string)$cheques->BCDefaultStatuses->DefaultStatusDescAr; 
                    } 
                    if(isset($cheques->BCDefaultStatuses->DefaultStatusCode)){
                        $simah_consumer_bounced_data['BCDefaultStatuses_DefaultStatusCode'] = (string)$cheques->BCDefaultStatuses->DefaultStatusCode; 
                    } 
                }
            }
            // PublicNotices
            $simah_consumer_public_notices_data = array();   
            if(isset($response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoDateLoaded)){
                $PublicNoDateLoaded = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoDateLoaded);
                $simah_consumer_public_notices_data['PublicNoDateLoaded'] = date('Y-m-d',strtotime($PublicNoDateLoaded)) ; 
            }    
            if(isset($response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTypes->PublicNoticeTypeDescEn)){
                $simah_consumer_public_notices_data['PublicNoTypes_PublicNoticeTypeDescEn'] =  (string)$response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTypes->PublicNoticeTypeDescEn; 
            }    
            if(isset($response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTypes->PublicNoticeTypeDescAr)){
                $simah_consumer_public_notices_data['PublicNoTypes_PublicNoticeTypeDescAr'] =  (string)$response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTypes->PublicNoticeTypeDescAr; 
            }    
            if(isset($response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTypes->PublicNoticeTypeCode)){
                $simah_consumer_public_notices_data['PublicNoTypes_PublicNoticeTypeCode'] =  (string)$response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTypes->PublicNoticeTypeCode; 
            }    
            if(isset($response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTextDescEn)){
                $simah_consumer_public_notices_data['PublicNoTextDescEn'] =  (string)$response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoTextDescEn; 
            }    
            if(isset($response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoComment)){
                $simah_consumer_public_notices_data['PublicNoComment'] =  (string)$response_array['Data']->ApplicationResponse->PublicNotices->ConsumerPublicNoticeView->PublicNoComment; 
            }   
            // Judgement 
            if(isset($response_array['Data']->ApplicationResponse->Judgements->JudgementView)){
                foreach($response_array['Data']->ApplicationResponse->Judgements->JudgementView as $judgement){
                    $simah_consumer_judgements_data = array();
                    if(isset($judgement->ExecutionDate)){
                        $ExecutionDate = str_replace("/","-",(string)$judgement->ExecutionDate);
                        $simah_consumer_judgements_data['ExecutionDate'] = date('Y-m-d',strtotime($ExecutionDate)) ; 
                    } 
                    if(isset($judgement->ResolutionNumber)){
                        $simah_consumer_judgements_data['ResolutionNumber'] = (string)$judgement->ResolutionNumber; 
                    } 
                    if(isset($judgement->CityNameEn)){
                        $simah_consumer_judgements_data['CityNameEn'] = (string)$judgement->CityNameEn; 
                    } 
                    if(isset($judgement->CityNameAr)){
                        $simah_consumer_judgements_data['CityNameAr'] = (string)$judgement->CityNameAr; 
                    } 
                    if(isset($judgement->CourtNameEn)){
                        $simah_consumer_judgements_data['CourtNameEn'] = (string)$judgement->CourtNameEn; 
                    } 
                    if(isset($judgement->CourtNameAr)){
                        $simah_consumer_judgements_data['CourtNameAr'] = (string)$judgement->CourtNameAr; 
                    } 
                    if(isset($judgement->LegalCaseNumber)){
                        $simah_consumer_judgements_data['LegalCaseNumber'] = (string)$judgement->LegalCaseNumber; 
                    } 
                    if(isset($judgement->LoadedDate)){
                        $LoadedDate = str_replace("/","-",(string)$judgement->LoadedDate);
                        $simah_consumer_judgements_data['LoadedDate'] = date('Y-m-d',strtotime($LoadedDate)) ; 
                    } 
                    if(isset($judgement->OriginalClaimedAmount)){
                        $simah_consumer_judgements_data['OriginalClaimedAmount'] = (string)$judgement->OriginalClaimedAmount; 
                    } 
                    if(isset($judgement->OutstandingBalance)){
                        $simah_consumer_judgements_data['OutstandingBalance'] = (string)$judgement->OutstandingBalance; 
                    } 
                    if(isset($judgement->StatusNameEn)){
                        $simah_consumer_judgements_data['StatusNameEn'] = (string)$judgement->StatusNameEn; 
                    } 
                    if(isset($judgement->StatusNameAr)){
                        $simah_consumer_judgements_data['StatusNameAr'] = (string)$judgement->StatusNameAr; 
                    } 
                    if(isset($judgement->ExecutionType)){
                        $simah_consumer_judgements_data['ExecutionType'] = (string)$judgement->ExecutionType; 
                    } 
                    if(isset($judgement->StatusCode)){
                        $simah_consumer_judgements_data['StatusCode'] = (string)$judgement->StatusCode; 
                    } 
                    if(isset($judgement->CityCode)){
                        $simah_consumer_judgements_data['CityCode'] = (string)$judgement->CityCode; 
                    } 
                }
            }
            // Addresses
            if(isset($response_array['Data']->ApplicationResponse->Addresses->ConsumerAddressView)){
                foreach($response_array['Data']->ApplicationResponse->Addresses->ConsumerAddressView as $address){
                    $simah_consumer_address_data = array();
                    if(isset($address->AdrsDateLoaded)){
                        $AdrsDateLoaded = str_replace("/","-",(string)$address->AdrsDateLoaded);
                        $simah_consumer_address_data['AdrsDateLoaded'] =  date('Y-m-d',strtotime($AdrsDateLoaded)); 
                    } 
                    if(isset($address->AdrsAddressTypes->AddressID)){
                        $simah_consumer_address_data['AdrsAddressTypes_AddressID'] =  (string)$address->AdrsAddressTypes->AddressID; 
                    } 
                    if(isset($address->AdrsAddressTypes->AddressTypeCode)){
                        $simah_consumer_address_data['AdrsAddressTypes_AddressTypeCode'] =  (string)$address->AdrsAddressTypes->AddressTypeCode; 
                    } 
                    if(isset($address->AdrsAddressTypes->AddressNameAR)){
                        $simah_consumer_address_data['AdrsAddressTypes_AddressNameAR'] =  (string)$address->AdrsAddressTypes->AddressNameAR; 
                    } 
                    if(isset($address->AdrsAddressTypes->AddressNameEN)){
                        $simah_consumer_address_data['AdrsAddressTypes_AddressNameEN'] =  (string)$address->AdrsAddressTypes->AddressNameEN; 
                    } 
                    if(isset($address->AdrsAddressLineFirstDescAr)){
                        $simah_consumer_address_data['AdrsAddressLineFirstDescAr'] =  (string)$address->AdrsAddressLineFirstDescAr; 
                    } 
                    if(isset($address->AdrsAddressLineFirstDescEn)){
                        $simah_consumer_address_data['AdrsAddressLineFirstDescEn'] =  (string)$address->AdrsAddressLineFirstDescEn; 
                    } 
                    if(isset($address->AdrsAddressLineSecondDescAr)){
                        $simah_consumer_address_data['AdrsAddressLineSecondDescAr'] =  (string)$address->AdrsAddressLineSecondDescAr; 
                    } 
                    if(isset($address->AdrsAddressLineSecondDescEn)){
                        $simah_consumer_address_data['AdrsAddressLineSecondDescEn'] =  (string)$address->AdrsAddressLineSecondDescEn; 
                    } 
                    if(isset($address->AdrsPOBox)){
                        $simah_consumer_address_data['AdrsPOBox'] =  (string)$address->AdrsPOBox; 
                    } 
                    if(isset($address->AdrsPostalCode)){
                        $simah_consumer_address_data['AdrsPostalCode'] =  (string)$address->AdrsPostalCode; 
                    } 
                    if(isset($address->AdrsCityDescAr)){
                        $simah_consumer_address_data['AdrsCityDescAr'] =  (string)$address->AdrsCityDescAr; 
                    } 
                    if(isset($address->AdrsCityDescEn)){
                        $simah_consumer_address_data['AdrsCityDescEn'] =  (string)$address->AdrsCityDescEn; 
                    } 
                    if(isset($address->NationalAddress->BuildingNumber)){
                        $simah_consumer_address_data['NationalAddress_BuildingNumber'] =  (string)$address->NationalAddress->BuildingNumber; 
                    } 
                    if(isset($address->NationalAddress->StreetAr)){
                        $simah_consumer_address_data['NationalAddress_StreetAr'] =  (string)$address->NationalAddress->StreetAr; 
                    } 
                    if(isset($address->NationalAddress->StreetEn)){
                        $simah_consumer_address_data['NationalAddress_StreetEn'] =  (string)$address->NationalAddress->StreetEn; 
                    } 
                    if(isset($address->NationalAddress->DistrictAr)){
                        $simah_consumer_address_data['NationalAddress_DistrictAr'] =  (string)$address->NationalAddress->DistrictAr; 
                    } 
                    if(isset($address->NationalAddress->DistrictEn)){
                        $simah_consumer_address_data['NationalAddress_DistrictEn'] =  (string)$address->NationalAddress->DistrictEn; 
                    } 
                    if(isset($address->NationalAddress->AdditionalNumber)){
                        $simah_consumer_address_data['NationalAddress_AdditionalNumber'] =  (string)$address->NationalAddress->AdditionalNumber; 
                    } 
                    if(isset($address->NationalAddress->UnitNumber)){
                        $simah_consumer_address_data['NationalAddress_UnitNumber'] =  (string)$address->NationalAddress->UnitNumber; 
                    } 
                }
            }
            // Contacts
            if(isset($response_array['Data']->ApplicationResponse->Contacts->ConsumerContactView)){
                foreach($response_array['Data']->ApplicationResponse->Contacts->ConsumerContactView as $contact){
                    $simah_consumer_contacts_data = array();
                    if(isset($contact->ConNumberTypes->ContactNumberTypeCode)){
                        $simah_consumer_contacts_data['ConNumberTypes_ContactNumberTypeCode'] =  (string)$contact->ConNumberTypes->ContactNumberTypeCode; 
                    } 
                    if(isset($contact->ConNumberTypes->ContactNumberTypeDescriptionAr)){
                        $simah_consumer_contacts_data['ConNumberTypes_ContactNumberTypeDescriptionAr'] =  (string)$contact->ConNumberTypes->ContactNumberTypeDescriptionAr; 
                    } 
                    if(isset($contact->ConNumberTypes->ContactNumberTypeDescriptionEn)){
                        $simah_consumer_contacts_data['ConNumberTypes_ContactNumberTypeDescriptionEn'] =  (string)$contact->ConNumberTypes->ContactNumberTypeDescriptionEn; 
                    } 
                    if(isset($contact->ConCode)){
                        $simah_consumer_contacts_data['ConCode'] =  (string)$contact->ConCode; 
                    } 
                    if(isset($contact->ConAreaCode)){
                        $simah_consumer_contacts_data['ConAreaCode'] =  (string)$contact->ConAreaCode; 
                    } 
                    if(isset($contact->ConPhoneNumber)){
                        $simah_consumer_contacts_data['ConPhoneNumber'] =  (string)$contact->ConPhoneNumber; 
                    } 
                }
            }
            // Employees
            if(isset($response_array['Data']->ApplicationResponse->Employers->EmployerView)){
                foreach($response_array['Data']->ApplicationResponse->Employers->EmployerView as $employees){
                    $simah_consumer_employer_data = array();
                    if(isset($employees->EmpEmployerNameDescAr)){
                        $simah_consumer_employer_data['EmpEmployerNameDescAr'] =  (string)$employees->EmpEmployerNameDescAr; 
                    } 
                    if(isset($employees->EmpEmployerNameDescEn)){
                        $simah_consumer_employer_data['EmpEmployerNameDescEn'] =  (string)$employees->EmpEmployerNameDescEn; 
                    } 
                    if(isset($employees->EmpOccupationDescAr)){
                        $simah_consumer_employer_data['EmpOccupationDescAr'] =  (string)$employees->EmpOccupationDescAr; 
                    } 
                    if(isset($employees->EmpOccupationDescEn)){
                        $simah_consumer_employer_data['EmpOccupationDescEn'] =  (string)$employees->EmpOccupationDescEn; 
                    } 
                    if(isset($employees->EmpDateOfEmployment)){
                        $EmpDateOfEmployment = str_replace("/","-",(string)$employees->EmpDateOfEmployment);
                        $simah_consumer_employer_data['EmpDateOfEmployment'] = date('Y-m-d',strtotime($EmpDateOfEmployment)) ; 
                    } 
                    if(isset($employees->EmpDateLoaded)){
                        $EmpDateLoaded = str_replace("/","-",(string)$employees->EmpDateLoaded);
                        $simah_consumer_employer_data['EmpDateLoaded'] = date('Y-m-d',strtotime($EmpDateLoaded)) ; 
                    } 
                    if(isset($employees->EmpIncome)){
                        $simah_consumer_employer_data['EmpIncome'] =  (string)$employees->EmpIncome; 
                    } 
                    if(isset($employees->EmpTotalIncome)){
                        $simah_consumer_employer_data['EmpTotalIncome'] =  (string)$employees->EmpTotalIncome; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressTypes->AddressID)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressTypes_AddressID'] =  (string)$employees->EmpAddress->AdrsAddressTypes->AddressID; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressTypes->AddressTypeCode)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressTypes_AddressTypeCode'] =  (string)$employees->EmpAddress->AdrsAddressTypes->AddressTypeCode; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressTypes->AddressNameAR)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressTypes_AddressNameAR'] =  (string)$employees->EmpAddress->AdrsAddressTypes->AddressNameAR; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressTypes->AddressNameEN)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressTypes_AddressNameEN'] =  (string)$employees->EmpAddress->AdrsAddressTypes->AddressNameEN; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressLineFirstDescAr)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressLineFirstDescAr'] =  (string)$employees->EmpAddress->AdrsAddressLineFirstDescAr; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressLineFirstDescEn)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressLineFirstDescEn'] =  (string)$employees->EmpAddress->AdrsAddressLineFirstDescEn; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressLineSecondDescAr)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressLineSecondDescAr'] =  (string)$employees->EmpAddress->AdrsAddressLineSecondDescAr; 
                    } 
                    if(isset($employees->EmpAddress->AdrsAddressLineSecondDescEn)){
                        $simah_consumer_employer_data['EmpAddress_AdrsAddressLineSecondDescEn'] =  (string)$employees->EmpAddress->AdrsAddressLineSecondDescEn; 
                    } 
                    if(isset($employees->EmpAddress->AdrsPOBox)){
                        $simah_consumer_employer_data['EmpAddress_AdrsPOBox'] =  (string)$employees->EmpAddress->AdrsPOBox; 
                    } 
                    if(isset($employees->EmpAddress->AdrsPostalCode)){
                        $simah_consumer_employer_data['EmpAddress_AdrsPostalCode'] =  (string)$employees->EmpAddress->AdrsPostalCode; 
                    } 
                    if(isset($employees->EmpAddress->AdrsCityDescAr)){
                        $simah_consumer_employer_data['EmpAddress_AdrsCityDescAr'] =  (string)$employees->EmpAddress->AdrsCityDescAr; 
                    } 
                    if(isset($employees->EmpAddress->AdrsCityDescEn)){
                        $simah_consumer_employer_data['EmpAddress_AdrsCityDescEn'] =  (string)$employees->EmpAddress->AdrsCityDescEn; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->BuildingNumber)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_BuildingNumber'] =  (string)$employees->EmpAddress->NationalAddress->BuildingNumber; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->StreetAr)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_StreetAr'] =  (string)$employees->EmpAddress->NationalAddress->StreetAr; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->StreetEn)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_StreetEn'] =  (string)$employees->EmpAddress->NationalAddress->StreetEn; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->DistrictAr)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_DistrictAr'] =  (string)$employees->EmpAddress->NationalAddress->DistrictAr; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->DistrictEn)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_DistrictEn'] =  (string)$employees->EmpAddress->NationalAddress->DistrictEn; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->AdditionalNumber)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_AdditionalNumber'] =  (string)$employees->EmpAddress->NationalAddress->AdditionalNumber; 
                    } 
                    if(isset($employees->EmpAddress->NationalAddress->UnitNumber)){
                        $simah_consumer_employer_data['EmpAddress_NationalAddress_UnitNumber'] =  (string)$employees->EmpAddress->NationalAddress->UnitNumber; 
                    } 
                    if(isset($employees->EmpStatusType->EmployerStatusTypeCode)){
                        $simah_consumer_employer_data['EmpStatusType_EmployerStatusTypeCode'] =  (string)$employees->EmpStatusType->EmployerStatusTypeCode; 
                    } 
                    if(isset($employees->EmpStatusType->EmployerStatusTypeDescAr)){
                        $simah_consumer_employer_data['EmpStatusType_EmployerStatusTypeDescAr'] =  (string)$employees->EmpStatusType->EmployerStatusTypeDescAr; 
                    } 
                    if(isset($employees->EmpStatusType->EmployerStatusTypeDescEn)){
                        $simah_consumer_employer_data['EmpStatusType_EmployerStatusTypeDescEn'] =  (string)$employees->EmpStatusType->EmployerStatusTypeDescEn; 
                    } 
                    
                }
            }
            // Summary info
            $simah_consumer_summary_data = array();
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummActiveCreditInstruments)){
                $simah_consumer_summary_data['SummActiveCreditInstruments'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummActiveCreditInstruments; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummDefaults)){
                $simah_consumer_summary_data['SummDefaults'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummDefaults; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummEarliestIssueDate)){
                $SummEarliestIssueDate = str_replace("/","-",(string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummEarliestIssueDate);
                $simah_consumer_summary_data['SummEarliestIssueDate'] = date('Y-m-d',strtotime($SummEarliestIssueDate)) ; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalLimits)){
                $simah_consumer_summary_data['SummTotalLimits'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalLimits; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalGuaranteedLimits)){
                $simah_consumer_summary_data['SummTotalGuaranteedLimits'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalGuaranteedLimits; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalLiablilites)){
                $simah_consumer_summary_data['SummTotalLiablilites'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalLiablilites; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalGuaranteedLiablilites)){
                $simah_consumer_summary_data['SummTotalGuaranteedLiablilites'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalGuaranteedLiablilites; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalDefaults)){
                $simah_consumer_summary_data['SummTotalDefaults'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummTotalDefaults; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummCurrentDelinquentBalance)){
                $simah_consumer_summary_data['SummCurrentDelinquentBalance'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummCurrentDelinquentBalance; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummPreviousEnquires)){
                $simah_consumer_summary_data['SummPreviousEnquires'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummPreviousEnquires; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummPreviousEnquiresThisMonth)){
                $simah_consumer_summary_data['SummPreviousEnquiresThisMonth'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummPreviousEnquiresThisMonth; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->SummaryInfo->SummGuaranteedCreditInstruments)){
                $simah_consumer_summary_data['SummGuaranteedCreditInstruments'] = (string)$response_array['Data']->ApplicationResponse->SummaryInfo->SummGuaranteedCreditInstruments; 
            } 
            // Score
            $simah_consumer_score_data = array();
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->Score)){
                $simah_consumer_score_data['Score'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->Score; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->ReasonCodes->ScoreReasonCode->ScoreReasonCodeName)){
                $simah_consumer_score_data['ReasonCodes_ScoreReasonCode_ScoreReasonCodeName'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->ReasonCodes->ScoreReasonCode->ScoreReasonCodeName; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->ReasonCodes->ScoreReasonCode->ScoreReasonCodeDescAr)){
                $simah_consumer_score_data['ReasonCodes_ScoreReasonCode_ScoreReasonCodeDescAr'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->ReasonCodes->ScoreReasonCode->ScoreReasonCodeDescAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->ReasonCodes->ScoreReasonCode->ScoreReasonCodeDescEn)){
                $simah_consumer_score_data['ReasonCodes_ScoreReasonCode_ScoreReasonCodeDescEn'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->ReasonCodes->ScoreReasonCode->ScoreReasonCodeDescEn; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->MinimumScore)){
                $simah_consumer_score_data['MinimumScore'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->MinimumScore; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->MaximumScore)){
                $simah_consumer_score_data['MaximumScore'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->MaximumScore; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->Score->ScoreView->ScoreIndex)){
                $simah_consumer_score_data['ScoreIndex'] = (string)$response_array['Data']->ApplicationResponse->Score->ScoreView->ScoreIndex; 
            } 
            // DisclerText
            $simah_disclaimer_data = array();
            if(isset($response_array['Data']->ApplicationResponse->DisclerText->DiscTextDescAr)){
                $simah_disclaimer_data['DiscTextDescAr'] = (string)$response_array['Data']->ApplicationResponse->DisclerText->DiscTextDescAr; 
            } 
            if(isset($response_array['Data']->ApplicationResponse->DisclerText->DiscTextDescEn)){
                $simah_disclaimer_data['DiscTextDescEn'] = (string)$response_array['Data']->ApplicationResponse->DisclerText->DiscTextDescEn; 
            } 

            // echo '<pre>';
            // var_dump($simah_consumer_public_notices_data);
            // exit; 
            // var_dump($response_array);
            // var_dump($response_array['Data']->ApplicationResponse->ReportDate);
            exit;
        }
    }
    public function get_sample_simah_response(){
        $response = '<NewResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
    <Message />
    <IsSuccess>true</IsSuccess>
    <Data>
        <ApplicationResponse>
            <ReportDate>11/12/2023</ReportDate>
            <ReportDetails>
                <ReportDate>11/12/2023</ReportDate>
                <EnquiryType>DMS Summary NA</EnquiryType>
                <ProductType>Consumer Durables Loan</ProductType>
                <EnquiryNumber>272734936</EnquiryNumber>
                <NumberOfApplicants>1</NumberOfApplicants>
                <AccountType>Single</AccountType>
                <ReferenceNumber>2099999EQ11122310225984</ReferenceNumber>
                <Amount>4000.00</Amount>
                <MemberType>
                    <Id>1</Id>
                    <Code>FULL</Code>
                    <NameAr>عضوية كامـلة </NameAr>
                    <Name>Full</Name>
                </MemberType>
                <Status>
                    <Id>1</Id>
                    <Code>ACTIV</Code>
                    <NameAr>فعال</NameAr>
                    <Name>Active</Name>
                </Status>
            </ReportDetails>
            <ProvidedDemographicsInfo>
                <DemIDNumber>1052372735</DemIDNumber>
                <DemIDType>
                    <TypeID>1</TypeID>
                    <TypeNameEN>National ID</TypeNameEN>
                    <TypeNameAR>هوية وطنية</TypeNameAR>
                    <IDTypeCode>T</IDTypeCode>
                </DemIDType>
                <DemIDExpiryDate>15/01/2026</DemIDExpiryDate>
                <DemApplicantType>
                    <ApplicantTypeID>-1</ApplicantTypeID>
                    <ApplicantTypeCode>P</ApplicantTypeCode>
                    <ApplicantTypeNameEN>Pimary</ApplicantTypeNameEN>
                    <ApplicantTypeNameAR>Primary</ApplicantTypeNameAR>
                </DemApplicantType>
                <DemCustomerName>Test Test Test Test</DemCustomerName>
                <DemFamilyName>Test</DemFamilyName>
                <DemFirstName>Test</DemFirstName>
                <DemSecondName>Test</DemSecondName>
                <DemThirdName>Test</DemThirdName>
                <DemCustomerNameAr>فحص فحص فحص فحص</DemCustomerNameAr>
                <DemFamilyNameAr>فحص</DemFamilyNameAr>
                <DemFirstNameAr>فحص</DemFirstNameAr>
                <DemSecondNameAr>فحص</DemSecondNameAr>
                <DemThirdNameAr>فحص</DemThirdNameAr>
                <DemDateOfBirth>09/09/1990</DemDateOfBirth>
                <DemGender>Male</DemGender>
                <DemMaritalStatus>
                    <MatrialStatusId>2</MatrialStatusId>
                    <StatusNameEN>Married</StatusNameEN>
                    <StatusNameAR>متزوج / ـة</StatusNameAR>
                    <MaritalStatusCode>M</MaritalStatusCode>
                </DemMaritalStatus>
                <DemNationality>
                    <COUID>0</COUID>
                    <CouNameEN>UNK</CouNameEN>
                    <CouNameAR>UNK</CouNameAR>
                </DemNationality>
            </ProvidedDemographicsInfo>
            <AvailableDemographicsInfo>
                <DemIDNumber>1052372735</DemIDNumber>
                <DemIDType>
                    <TypeID>1</TypeID>
                    <TypeNameEN>National ID</TypeNameEN>
                    <TypeNameAR>هوية وطنية</TypeNameAR>
                    <IDTypeCode>T</IDTypeCode>
                </DemIDType>
                <DemIDExpiryDate>15/01/2026</DemIDExpiryDate>
                <DemApplicantType>
                    <ApplicantTypeID>-1</ApplicantTypeID>
                    <ApplicantTypeCode>P</ApplicantTypeCode>
                    <ApplicantTypeNameEN>Pimary</ApplicantTypeNameEN>
                    <ApplicantTypeNameAR>Primary</ApplicantTypeNameAR>
                </DemApplicantType>
                <DemCustomerName>Test Test Test Test</DemCustomerName>
                <DemFamilyName>Test</DemFamilyName>
                <DemFirstName>Test</DemFirstName>
                <DemSecondName>Test</DemSecondName>
                <DemThirdName>Test</DemThirdName>
                <DemCustomerNameAr>فحص فحص فحص فحص</DemCustomerNameAr>
                <DemFamilyNameAr>فحص</DemFamilyNameAr>
                <DemFirstNameAr>فحص</DemFirstNameAr>
                <DemSecondNameAr>فحص</DemSecondNameAr>
                <DemThirdNameAr>فحص</DemThirdNameAr>
                <DemDateOfBirth>09/09/1990</DemDateOfBirth>
                <DemGender>Male</DemGender>
                <DemMaritalStatus>
                    <MatrialStatusId>2</MatrialStatusId>
                    <StatusNameEN>Married</StatusNameEN>
                    <StatusNameAR>متزوج / ـة</StatusNameAR>
                    <MaritalStatusCode>M</MaritalStatusCode>
                </DemMaritalStatus>
                <DemNationality>
                    <COUID>0</COUID>
                    <CouNameEN>UNK</CouNameEN>
                    <CouNameAR>UNK</CouNameAR>
                </DemNationality>
            </AvailableDemographicsInfo>
            <PrevEnquiries>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122312150692</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122311045009</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122311030292</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122311003934</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122311003366</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122311001645</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ08122310591710</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>07/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ07122316483953</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>07/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ07122316480749</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>07/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ07122316403695</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>07/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ07122314122934</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>06/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ06122313412661</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>119000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>05/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ05122315111280</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>45000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>05/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ05122312363180</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>167000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/12/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03122313020913</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>250000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>30/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ30112315204318</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>17000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>30/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ30112315074935</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>30/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ30112315032608</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>150000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>23/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ23112317462720</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>25</ProductId>
                        <Code>CDL</Code>
                        <TextEn>Consumer Durables Loan</TextEn>
                        <TextAr>تمويل منتجات استهلاكية - قروض</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ08112313152248</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>1000000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>07/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ07112310303525</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>06/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ06112314290235</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>121212.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>06/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ06112314260696</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>250000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>05/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ05112314142041</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>62626.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>05/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ05112309472375</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>95959.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02112314294871</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>250000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02112314202273</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02112312111821</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>150500.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02112311010806</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/11/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02112309425644</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>25/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>AGDF</MemberCode>
                        <MemberNameEN>AGRICULTURAL DEVELOPMENT FUND</MemberNameEN>
                        <MemberNameAR>صندوق التنمية الزراعيه</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200255EQ1181W3W23312</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>24</ProductId>
                        <Code>ADFL</Code>
                        <TextEn>Agricultural Loan</TextEn>
                        <TextAr>قرض زراعي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>12345.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>24/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ24102313370429</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>150000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>20/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ20102300162823</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>50000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>19/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ19102312100787</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>19/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ19102312055830</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>19/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQMM1697706005</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>1.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>18/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQ1697116438</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>146</ProductId>
                        <Code>COM</Code>
                        <TextEn>Commercial Enquiry</TextEn>
                        <TextAr>Commercial Enquiry</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>1.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17102312155460</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>99999.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17102312102612</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17102311301056</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17102309273965</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>12/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ12102316142308</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>322323.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>11/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ11102315372023</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>11/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ11102313224283</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>150000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>09/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ09102310192883</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>99999.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>09/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ09102309360949</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>09/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ09102309140579</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>09/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ09102301004357</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>15230.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>09/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ09102300341868</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>08/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>SBOX</MemberCode>
                        <MemberNameEN>SIMAH SANDBOX</MemberNameEN>
                        <MemberNameAR>سمة البيئة التجريبية</MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>2099999EQMM1231212</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>1.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102315512424</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102315472770</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>250000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102315414508</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>353535.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102315335112</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>88888.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314544179</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314530533</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>99999.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314474174</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>350000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314401570</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>120000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314395522</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314262306</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102314074025</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>99999.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102313052972</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>99999.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>02/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ02102313012110</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>60000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>01/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ01102315535802</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>01/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ01102310071822</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>750000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>01/10/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ01102309513735</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>250000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>28/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ28092315335694</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>28/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ28092315212139</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17092315132706</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>11111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17092315094216</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>11111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>17/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ17092314513575</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>20000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>13/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ13092312131021</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>11111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>13/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ13092311171691</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>11111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>13/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ13092311115226</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>111111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>13/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ13092311041532</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>11111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>12/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ12092316103783</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>33333.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>12/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ12092311013223</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>100000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>11/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ11092312574233</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>300000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>11/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ11092312412886</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>10/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ10092309522202</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>11111.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092302023866</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>5555.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092301585709</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>55555.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092301562291</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>28555.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092301513012</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>12345.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092301145930</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10085.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092300314404</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>43443.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092300271903</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>32323.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092300211277</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>21221.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092300105822</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>30000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>04/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ04092300074944</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>30000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092323381096</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>5445.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092322391569</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>12312.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092322292751</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4344.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092322152337</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>4343.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092322123346</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092321550023</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>123123.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092317175021</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>9999.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092317131572</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>90000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092316585012</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>10000.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092316552282</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>15222.0</PrevEnqAmount>
                </PrevEnquiryView>
                <PrevEnquiryView>
                    <PrevEnqDate>03/09/2023</PrevEnqDate>
                    <PreEnqType>
                        <EnqTypeCode>NA</EnqTypeCode>
                        <EnqTypeDescriptionAr>DMS Summary NA</EnqTypeDescriptionAr>
                        <EnqTypeDescriptionEn>DMS Summary NA</EnqTypeDescriptionEn>
                    </PreEnqType>
                    <PrevEnqEnquirer>
                        <MemberCode>CFDB</MemberCode>
                        <MemberNameEN>Creative Future for Digital Brokerage</MemberNameEN>
                        <MemberNameAR>مستقبل الابداع للوساطة الرقمية </MemberNameAR>
                    </PrevEnqEnquirer>
                    <PrevEnqMemberRef>200614EQ03092316113166</PrevEnqMemberRef>
                    <PrevEnquirerName>Test,Test,Test,Test</PrevEnquirerName>
                    <PrevEnquirerNameAr>فحص,فحص,فحص,فحص</PrevEnquirerNameAr>
                    <PrevEnqProductTypeDesc>
                        <ProductId>23</ProductId>
                        <Code>PLN</Code>
                        <TextEn>Personal Loan</TextEn>
                        <TextAr>قرض شخصي</TextAr>
                    </PrevEnqProductTypeDesc>
                    <PrevEnqAmount>30000.0</PrevEnqAmount>
                </PrevEnquiryView>
            </PrevEnquiries>
            <CreditInstrumentDetails>
                <CreditInstrumentDetailView>
                    <CICreditor>
                        <MemberCode>SSMC</MemberCode>
                        <MemberNameEN>SIMAH SOSS</MemberNameEN>
                        <MemberNameAR>شركة صحة السويدي الطبية</MemberNameAR>
                    </CICreditor>
                    <CIProductTypeDesc>
                        <ProductId>31</ProductId>
                        <Code>SLAN</Code>
                        <TextEn>Social Loan</TextEn>
                        <TextAr>قرض اجتماعي</TextAr>
                    </CIProductTypeDesc>
                    <CIAccountNumber>4020881352</CIAccountNumber>
                    <CILimit>60000.0</CILimit>
                    <CIIssuedDate>29/06/2015</CIIssuedDate>
                    <CIExpirationDate>07/02/2023</CIExpirationDate>
                    <CIStatus>
                        <CreditInstrumentStatusCode>A</CreditInstrumentStatusCode>
                        <CreditInstrumentStatusDescAr>نشط</CreditInstrumentStatusDescAr>
                        <CreditInstrumentStatusDescEn>Active</CreditInstrumentStatusDescEn>
                    </CIStatus>
                    <CITenure>75.0</CITenure>
                    <CIPaymentFrequency>
                        <PaymentFrequencyCodeDescEn>Monthly</PaymentFrequencyCodeDescEn>
                        <PaymentFrequencyCodeDescAr>شهري</PaymentFrequencyCodeDescAr>
                        <PaymentFrequencyCodeName>M</PaymentFrequencyCodeName>
                    </CIPaymentFrequency>
                    <CIInstallmentAmount>800.0</CIInstallmentAmount>
                    <CISalaryAssignmentFlag>
                        <SalaryAssignmentFlagDescEn>No</SalaryAssignmentFlagDescEn>
                        <SalaryAssignmentFlagDescAr>لا</SalaryAssignmentFlagDescAr>
                        <SalaryAssignmentFlagCode>N</SalaryAssignmentFlagCode>
                    </CISalaryAssignmentFlag>
                    <CIConsumerSecurityType>
                        <ConsumerSecurityTypeDescEn>None</ConsumerSecurityTypeDescEn>
                        <ConsumerSecurityTypeDescAr>لاتوجد</ConsumerSecurityTypeDescAr>
                        <ConsumerSecurityTypeCode>NO</ConsumerSecurityTypeCode>
                    </CIConsumerSecurityType>
                    <CIOutstandingBalance>28800.0</CIOutstandingBalance>
                    <CIPastDue>0.0</CIPastDue>
                    <CILastAmountPaid>800.0</CILastAmountPaid>
                    <CILastPaymentDate>22/10/2019</CILastPaymentDate>
                    <CIAsOfDate>17/10/2019</CIAsOfDate>
                    <CINextDueDate>17/11/2019</CINextDueDate>
                    <CISummary>MMMMMMMMMMMMMMMMMMMMMMMM</CISummary>
                    <CIDownPayment>0.0</CIDownPayment>
                    <CIDispensedAmount>0.0</CIDispensedAmount>
                    <CIMaxInstalmentAmount>0.0</CIMaxInstalmentAmount>
                    <MultiInstalmentDetails />
                    <CIAverageInstallmentAmount>0.0</CIAverageInstallmentAmount>
                </CreditInstrumentDetailView>
            </CreditInstrumentDetails>
            <BouncedCheques>
                <ConsumerBouncedChequeView>
                    <BCCheqDateLoaded>25/01/2023</BCCheqDateLoaded>
                    <BCProductTypeDesc>
                        <ProductId>63</ProductId>
                        <Code>CHCK</Code>
                        <TextEn>Bounced Cheques</TextEn>
                        <TextAr>الشيكات المرتجعة</TextAr>
                    </BCProductTypeDesc>
                    <BCCreditor>
                        <MemberNameEN>XBAN</MemberNameEN>
                        <MemberNameAR>XBAN</MemberNameAR>
                    </BCCreditor>
                    <BCChequeNumber>A168201582858000-269</BCChequeNumber>
                    <BCBalance>42700.0</BCBalance>
                    <BCOutstandingBalance>42700.0</BCOutstandingBalance>
                    <BCDefaultStatuses>
                        <DefaultStatusDescEn>Registered</DefaultStatusDescEn>
                        <DefaultStatusDescAr>مسجل</DefaultStatusDescAr>
                        <DefaultStatusCode>RG</DefaultStatusCode>
                    </BCDefaultStatuses>
                </ConsumerBouncedChequeView>
                <ConsumerBouncedChequeView>
                    <BCCheqDateLoaded>19/06/2023</BCCheqDateLoaded>
                    <BCProductTypeDesc>
                        <ProductId>63</ProductId>
                        <Code>CHCK</Code>
                        <TextEn>Bounced Cheques</TextEn>
                        <TextAr>الشيكات المرتجعة</TextAr>
                    </BCProductTypeDesc>
                    <BCCreditor>
                        <MemberNameEN>XBAN</MemberNameEN>
                        <MemberNameAR>XBAN</MemberNameAR>
                    </BCCreditor>
                    <BCChequeNumber>TESTING-CHCK-AMOUNT002</BCChequeNumber>
                    <BCBalance>550.0</BCBalance>
                    <BCOutstandingBalance>550.0</BCOutstandingBalance>
                    <BCDefaultStatuses>
                        <DefaultStatusDescEn>Registered</DefaultStatusDescEn>
                        <DefaultStatusDescAr>مسجل</DefaultStatusDescAr>
                        <DefaultStatusCode>RG</DefaultStatusCode>
                    </BCDefaultStatuses>
                </ConsumerBouncedChequeView>
                <ConsumerBouncedChequeView>
                    <BCCheqDateLoaded>05/03/2023</BCCheqDateLoaded>
                    <BCProductTypeDesc>
                        <ProductId>63</ProductId>
                        <Code>CHCK</Code>
                        <TextEn>Bounced Cheques</TextEn>
                        <TextAr>الشيكات المرتجعة</TextAr>
                    </BCProductTypeDesc>
                    <BCCreditor>
                        <MemberNameEN>XBAN</MemberNameEN>
                        <MemberNameAR>XBAN</MemberNameAR>
                    </BCCreditor>
                    <BCChequeNumber>AB268201582858000-269</BCChequeNumber>
                    <BCBalance>42700.0</BCBalance>
                    <BCOutstandingBalance>42700.0</BCOutstandingBalance>
                    <BCDefaultStatuses>
                        <DefaultStatusDescEn>Registered</DefaultStatusDescEn>
                        <DefaultStatusDescAr>مسجل</DefaultStatusDescAr>
                        <DefaultStatusCode>RG</DefaultStatusCode>
                    </BCDefaultStatuses>
                </ConsumerBouncedChequeView>
            </BouncedCheques>
            <PublicNotices>
                <ConsumerPublicNoticeView>
                    <PublicNoDateLoaded>25/01/2023</PublicNoDateLoaded>
                    <PublicNoTypes>
                        <PublicNoticeTypeDescEn>General</PublicNoticeTypeDescEn>
                        <PublicNoticeTypeDescAr>عام</PublicNoticeTypeDescAr>
                        <PublicNoticeTypeCode>GENRL</PublicNoticeTypeCode>
                    </PublicNoTypes>
                    <PublicNoTextDescEn>Saudi Credit Bureau SIMAH</PublicNoTextDescEn>
                    <PublicNoComment>TEST</PublicNoComment>
                </ConsumerPublicNoticeView>
            </PublicNotices>
            <Judgements>
                <JudgementView>
                    <ExecutionDate>23/01/2023</ExecutionDate>
                    <ResolutionNumber>2510201005</ResolutionNumber>
                    <CityNameEn>Riyadh</CityNameEn>
                    <CityNameAr>الرياض</CityNameAr>
                    <CourtNameEn>Thirteenth Executive Courthouse</CourtNameEn>
                    <CourtNameAr>دائرة التنفيذ الثالثة عشر</CourtNameAr>
                    <LegalCaseNumber>ab22510201005_1234567890</LegalCaseNumber>
                    <LoadedDate>05/03/2023</LoadedDate>
                    <OriginalClaimedAmount>14,400.00</OriginalClaimedAmount>
                    <OutstandingBalance>14,400.00</OutstandingBalance>
                    <StatusNameEn>Not Executed</StatusNameEn>
                    <StatusNameAr>عدم تنفيذ</StatusNameAr>
                    <ExecutionType>EXE02</ExecutionType>
                    <StatusCode>NOTEX</StatusCode>
                    <CityCode>RIY</CityCode>
                </JudgementView>
                <JudgementView>
                    <ExecutionDate>23/01/2023</ExecutionDate>
                    <ResolutionNumber>2510201005</ResolutionNumber>
                    <CityNameEn>Riyadh</CityNameEn>
                    <CityNameAr>الرياض</CityNameAr>
                    <CourtNameEn>Thirteenth Executive Courthouse</CourtNameEn>
                    <CourtNameAr>دائرة التنفيذ الثالثة عشر</CourtNameAr>
                    <LegalCaseNumber>a12510201005_1234567890</LegalCaseNumber>
                    <LoadedDate>25/01/2023</LoadedDate>
                    <OriginalClaimedAmount>14,400.00</OriginalClaimedAmount>
                    <OutstandingBalance>14,400.00</OutstandingBalance>
                    <StatusNameEn>Not Executed</StatusNameEn>
                    <StatusNameAr>عدم تنفيذ</StatusNameAr>
                    <ExecutionType>EXE02</ExecutionType>
                    <StatusCode>NOTEX</StatusCode>
                    <CityCode>RIY</CityCode>
                </JudgementView>
            </Judgements>
            <Addresses>
                <ConsumerAddressView>
                    <AdrsDateLoaded>23/11/2023</AdrsDateLoaded>
                    <AdrsAddressTypes>
                        <AddressID>6</AddressID>
                        <AddressTypeCode>NATAD</AddressTypeCode>
                        <AddressNameAR>وطني</AddressNameAR>
                        <AddressNameEN>National</AddressNameEN>
                    </AdrsAddressTypes>
                    <AdrsAddressLineFirstDescAr>العنوان الاول</AdrsAddressLineFirstDescAr>
                    <AdrsAddressLineFirstDescEn>ADDRESS LINE 1</AdrsAddressLineFirstDescEn>
                    <AdrsAddressLineSecondDescAr>العنوان الثاني</AdrsAddressLineSecondDescAr>
                    <AdrsAddressLineSecondDescEn>ADDRESS LINE 2</AdrsAddressLineSecondDescEn>
                    <AdrsPOBox>9999</AdrsPOBox>
                    <AdrsPostalCode>9999</AdrsPostalCode>
                    <AdrsCityDescAr>الرياض</AdrsCityDescAr>
                    <AdrsCityDescEn>Riyadh</AdrsCityDescEn>
                    <NationalAddress>
                        <BuildingNumber>9999</BuildingNumber>
                        <StreetAr>9999</StreetAr>
                        <StreetEn>STREET NAME</StreetEn>
                        <DistrictAr>الرياض</DistrictAr>
                        <DistrictEn>Riyadh</DistrictEn>
                        <AdditionalNumber>9999</AdditionalNumber>
                        <UnitNumber>99</UnitNumber>
                    </NationalAddress>
                </ConsumerAddressView>
                <ConsumerAddressView>
                    <AdrsDateLoaded>25/10/2023</AdrsDateLoaded>
                    <AdrsAddressTypes>
                        <AddressID>6</AddressID>
                        <AddressTypeCode>NATAD</AddressTypeCode>
                        <AddressNameAR>وطني</AddressNameAR>
                        <AddressNameEN>National</AddressNameEN>
                    </AdrsAddressTypes>
                    <AdrsAddressLineFirstDescAr>العنوان الاول</AdrsAddressLineFirstDescAr>
                    <AdrsAddressLineFirstDescEn>ADDRESS LINE 1</AdrsAddressLineFirstDescEn>
                    <AdrsAddressLineSecondDescAr>العنوان الثاني</AdrsAddressLineSecondDescAr>
                    <AdrsAddressLineSecondDescEn>ADDRESS LINE 2</AdrsAddressLineSecondDescEn>
                    <AdrsPOBox>9999</AdrsPOBox>
                    <AdrsPostalCode>9999</AdrsPostalCode>
                    <AdrsCityDescAr>الرياض</AdrsCityDescAr>
                    <AdrsCityDescEn>Riyadh</AdrsCityDescEn>
                    <NationalAddress>
                        <BuildingNumber>9999</BuildingNumber>
                        <StreetAr>9999</StreetAr>
                        <StreetEn>STREET NAME</StreetEn>
                        <DistrictAr>الرياض</DistrictAr>
                        <DistrictEn>Riyadh</DistrictEn>
                        <AdditionalNumber>9999</AdditionalNumber>
                        <UnitNumber>99</UnitNumber>
                    </NationalAddress>
                </ConsumerAddressView>
                <ConsumerAddressView>
                    <AdrsDateLoaded>18/10/2023</AdrsDateLoaded>
                    <AdrsAddressTypes>
                        <AddressID>6</AddressID>
                        <AddressTypeCode>NATAD</AddressTypeCode>
                        <AddressNameAR>وطني</AddressNameAR>
                        <AddressNameEN>National</AddressNameEN>
                    </AdrsAddressTypes>
                    <AdrsAddressLineFirstDescAr>العنوان الاول</AdrsAddressLineFirstDescAr>
                    <AdrsAddressLineFirstDescEn>ADDRESS LINE 1</AdrsAddressLineFirstDescEn>
                    <AdrsAddressLineSecondDescAr>العنوان الثاني</AdrsAddressLineSecondDescAr>
                    <AdrsAddressLineSecondDescEn>ADDRESS LINE 2</AdrsAddressLineSecondDescEn>
                    <AdrsPOBox>9999</AdrsPOBox>
                    <AdrsPostalCode>9999</AdrsPostalCode>
                    <AdrsCityDescAr>الرياض</AdrsCityDescAr>
                    <AdrsCityDescEn>Riyadh</AdrsCityDescEn>
                    <NationalAddress>
                        <BuildingNumber>9999</BuildingNumber>
                        <StreetAr>9999</StreetAr>
                        <StreetEn>STREET NAME</StreetEn>
                        <DistrictAr>الرياض</DistrictAr>
                        <DistrictEn>Riyadh</DistrictEn>
                        <AdditionalNumber>9999</AdditionalNumber>
                        <UnitNumber>99</UnitNumber>
                    </NationalAddress>
                </ConsumerAddressView>
            </Addresses>
            <Contacts>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>1</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>000</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
                <ConsumerContactView>
                    <ConNumberTypes>
                        <ContactNumberTypeCode>M</ContactNumberTypeCode>
                        <ContactNumberTypeDescriptionAr>الجوال</ContactNumberTypeDescriptionAr>
                        <ContactNumberTypeDescriptionEn>Mobile</ContactNumberTypeDescriptionEn>
                    </ConNumberTypes>
                    <ConCode>Saudi Arabia</ConCode>
                    <ConAreaCode>0</ConAreaCode>
                    <ConPhoneNumber>999999999</ConPhoneNumber>
                </ConsumerContactView>
            </Contacts>
            <Employers>
                <EmployerView>
                    <EmpEmployerNameDescAr>موظف حكومي</EmpEmployerNameDescAr>
                    <EmpEmployerNameDescEn>Government Employer</EmpEmployerNameDescEn>
                    <EmpOccupationDescAr>موظف حكومي</EmpOccupationDescAr>
                    <EmpOccupationDescEn>Government Employee</EmpOccupationDescEn>
                    <EmpDateOfEmployment>01/01/2015</EmpDateOfEmployment>
                    <EmpDateLoaded>11/12/2023</EmpDateLoaded>
                    <EmpIncome>10000</EmpIncome>
                    <EmpTotalIncome>10000</EmpTotalIncome>
                    <EmpAddress>
                        <AdrsAddressTypes>
                            <AddressID>6</AddressID>
                            <AddressTypeCode>NATAD</AddressTypeCode>
                            <AddressNameAR>وطني</AddressNameAR>
                            <AddressNameEN>National</AddressNameEN>
                        </AdrsAddressTypes>
                        <AdrsAddressLineFirstDescAr>العنوان الاول</AdrsAddressLineFirstDescAr>
                        <AdrsAddressLineFirstDescEn>ADDRESS LINE 1</AdrsAddressLineFirstDescEn>
                        <AdrsAddressLineSecondDescAr>العنوان الثاني</AdrsAddressLineSecondDescAr>
                        <AdrsAddressLineSecondDescEn>ADDRESS LINE 2</AdrsAddressLineSecondDescEn>
                        <AdrsPOBox>9999</AdrsPOBox>
                        <AdrsPostalCode>9999</AdrsPostalCode>
                        <AdrsCityDescAr>الرياض</AdrsCityDescAr>
                        <AdrsCityDescEn>Riyadh</AdrsCityDescEn>
                        <NationalAddress>
                            <BuildingNumber>9999</BuildingNumber>
                            <StreetAr>شارع العمل</StreetAr>
                            <StreetEn>Employer Street</StreetEn>
                            <DistrictAr>الرياض</DistrictAr>
                            <DistrictEn>Riyadh</DistrictEn>
                            <AdditionalNumber>9999</AdditionalNumber>
                            <UnitNumber>99</UnitNumber>
                        </NationalAddress>
                    </EmpAddress>
                    <EmpStatusType>
                        <EmployerStatusTypeCode>C </EmployerStatusTypeCode>
                        <EmployerStatusTypeDescAr> الحالي</EmployerStatusTypeDescAr>
                        <EmployerStatusTypeDescEn>Current</EmployerStatusTypeDescEn>
                    </EmpStatusType>
                </EmployerView>
                <EmployerView>
                    <EmpEmployerNameDescAr>موظف حكومي</EmpEmployerNameDescAr>
                    <EmpEmployerNameDescEn>Government Employer</EmpEmployerNameDescEn>
                    <EmpOccupationDescAr>موظف حكومي</EmpOccupationDescAr>
                    <EmpOccupationDescEn>Government Employee</EmpOccupationDescEn>
                    <EmpDateOfEmployment>01/01/2015</EmpDateOfEmployment>
                    <EmpDateLoaded>08/12/2023</EmpDateLoaded>
                    <EmpIncome>10000</EmpIncome>
                    <EmpTotalIncome>10000</EmpTotalIncome>
                    <EmpAddress>
                        <AdrsAddressTypes>
                            <AddressID>6</AddressID>
                            <AddressTypeCode>NATAD</AddressTypeCode>
                            <AddressNameAR>وطني</AddressNameAR>
                            <AddressNameEN>National</AddressNameEN>
                        </AdrsAddressTypes>
                        <AdrsAddressLineFirstDescAr>العنوان الاول</AdrsAddressLineFirstDescAr>
                        <AdrsAddressLineFirstDescEn>ADDRESS LINE 1</AdrsAddressLineFirstDescEn>
                        <AdrsAddressLineSecondDescAr>العنوان الثاني</AdrsAddressLineSecondDescAr>
                        <AdrsAddressLineSecondDescEn>ADDRESS LINE 2</AdrsAddressLineSecondDescEn>
                        <AdrsPOBox>9999</AdrsPOBox>
                        <AdrsPostalCode>9999</AdrsPostalCode>
                        <AdrsCityDescAr>الرياض</AdrsCityDescAr>
                        <AdrsCityDescEn>Riyadh</AdrsCityDescEn>
                        <NationalAddress>
                            <BuildingNumber>9999</BuildingNumber>
                            <StreetAr>شارع العمل</StreetAr>
                            <StreetEn>Employer Street</StreetEn>
                            <DistrictAr>الرياض</DistrictAr>
                            <DistrictEn>Riyadh</DistrictEn>
                            <AdditionalNumber>9999</AdditionalNumber>
                            <UnitNumber>99</UnitNumber>
                        </NationalAddress>
                    </EmpAddress>
                    <EmpStatusType>
                        <EmployerStatusTypeCode>C </EmployerStatusTypeCode>
                        <EmployerStatusTypeDescAr> الحالي</EmployerStatusTypeDescAr>
                        <EmployerStatusTypeDescEn>Current</EmployerStatusTypeDescEn>
                    </EmpStatusType>
                </EmployerView>
                <EmployerView>
                    <EmpEmployerNameDescAr>موظف حكومي</EmpEmployerNameDescAr>
                    <EmpEmployerNameDescEn>Government Employer</EmpEmployerNameDescEn>
                    <EmpOccupationDescAr>موظف حكومي</EmpOccupationDescAr>
                    <EmpOccupationDescEn>Government Employee</EmpOccupationDescEn>
                    <EmpDateOfEmployment>01/01/2015</EmpDateOfEmployment>
                    <EmpDateLoaded>07/12/2023</EmpDateLoaded>
                    <EmpIncome>10000</EmpIncome>
                    <EmpTotalIncome>10000</EmpTotalIncome>
                    <EmpAddress>
                        <AdrsAddressTypes>
                            <AddressID>6</AddressID>
                            <AddressTypeCode>NATAD</AddressTypeCode>
                            <AddressNameAR>وطني</AddressNameAR>
                            <AddressNameEN>National</AddressNameEN>
                        </AdrsAddressTypes>
                        <AdrsAddressLineFirstDescAr>العنوان الاول</AdrsAddressLineFirstDescAr>
                        <AdrsAddressLineFirstDescEn>ADDRESS LINE 1</AdrsAddressLineFirstDescEn>
                        <AdrsAddressLineSecondDescAr>العنوان الثاني</AdrsAddressLineSecondDescAr>
                        <AdrsAddressLineSecondDescEn>ADDRESS LINE 2</AdrsAddressLineSecondDescEn>
                        <AdrsPOBox>9999</AdrsPOBox>
                        <AdrsPostalCode>9999</AdrsPostalCode>
                        <AdrsCityDescAr>الرياض</AdrsCityDescAr>
                        <AdrsCityDescEn>Riyadh</AdrsCityDescEn>
                        <NationalAddress>
                            <BuildingNumber>9999</BuildingNumber>
                            <StreetAr>شارع العمل</StreetAr>
                            <StreetEn>Employer Street</StreetEn>
                            <DistrictAr>الرياض</DistrictAr>
                            <DistrictEn>Riyadh</DistrictEn>
                            <AdditionalNumber>9999</AdditionalNumber>
                            <UnitNumber>99</UnitNumber>
                        </NationalAddress>
                    </EmpAddress>
                    <EmpStatusType>
                        <EmployerStatusTypeCode>C </EmployerStatusTypeCode>
                        <EmployerStatusTypeDescAr> الحالي</EmployerStatusTypeDescAr>
                        <EmployerStatusTypeDescEn>Current</EmployerStatusTypeDescEn>
                    </EmpStatusType>
                </EmployerView>
            </Employers>
            <SummaryInfo>
                <SummActiveCreditInstruments>1</SummActiveCreditInstruments>
                <SummDefaults>0.0</SummDefaults>
                <SummEarliestIssueDate>29/06/2015</SummEarliestIssueDate>
                <SummTotalLimits>60000</SummTotalLimits>
                <SummTotalGuaranteedLimits>0</SummTotalGuaranteedLimits>
                <SummTotalLiablilites>28800</SummTotalLiablilites>
                <SummTotalGuaranteedLiablilites>0</SummTotalGuaranteedLiablilites>
                <SummTotalDefaults>0</SummTotalDefaults>
                <SummCurrentDelinquentBalance>0.0</SummCurrentDelinquentBalance>
                <SummPreviousEnquires>101.0</SummPreviousEnquires>
                <SummPreviousEnquiresThisMonth>19.0</SummPreviousEnquiresThisMonth>
                <SummGuaranteedCreditInstruments>0.0</SummGuaranteedCreditInstruments>
            </SummaryInfo>
            <Score>
                <ScoreView>
                    <Score>0</Score>
                    <ReasonCodes>
                        <ScoreReasonCode>
                            <ScoreReasonCodeName>6</ScoreReasonCodeName>
                            <ScoreReasonCodeDescAr>نتيجة التقييم الصفر تعني لم يتم تقييم التقرير الائتماني لعدم وجود حسابات محدثة مؤخرا</ScoreReasonCodeDescAr>
                            <ScoreReasonCodeDescEn>Data available on the credit report is not recent and out of date to Score </ScoreReasonCodeDescEn>
                        </ScoreReasonCode>
                    </ReasonCodes>
                    <MinimumScore>300</MinimumScore>
                    <MaximumScore>850</MaximumScore>
                    <ScoreIndex>0</ScoreIndex>
                </ScoreView>
            </Score>
            <DisclerText>
                <DiscTextDescAr>المسؤولية القانونية: لقد تم تجميع هذه المعلومات من مصادر مختلفة على أساس السرية والخصوصية وهي لا تمثل رأي الشركة السعودية للمعلومات الائتمانية(سمة) ولا يلحق سمة أي مسؤولية قانونية نتيجة اتخاذ أي قرار استثماري أو غيره بناءً على المعلومات الواردة. الإفصاح: الشركة السعودية للمعلومات الائتمانية(سمة)، شركة مساهمة مقفلة، رأس مال 200.000.000 ريال مدفوع بالكامل، رقم السجل التجاري 1010171047، عضوية رقم 115731، الهاتف المجاني: 8003010046، رقم الفاكس: 966112188797 + ص.ب. 8859 الرياض 11492، العنوان الوطني: الرياض - حي الشهداء مبنى رقم: 2596، رقم الوحدة:1، الرقم الإضافي:7347، الرمز البريدي:13241. خاضعة لإشراف ورقابة البنك المركزي السعودي بموجب قرار الترخيص رقم 2 / 37.www.simah.com</DiscTextDescAr>
                <DiscTextDescEn>Disclaimer: This information has been collated from various sources on a confidential basis and doesnt represent the opinion of Saudi Credit Bureau (SIMAH). No Liability (in contract or otherwise whatsoever) attaches to SIMAH as a result of taking any investment and/or any other decision based on information provided. Disclosure: Saudi Credit Bureau, SIMAH, a Closed Joint Stock Company, Capital SR 200,000,000 Paid in Full- C.R 1010171047- Membership No.115731, Toll Free No. 8003010046, Fax No. 966112188797+  P.O Box 8859 Riyadh 11492- National Address: Riyadh, Al Shuhada, Building No. 2596, Unit No. 1, Additional No. 7347, Zip Code 13241. Under the Supervision and Regulation of SAMA with a License No. 2 / 37. www.simah.com</DiscTextDescEn>
            </DisclerText>
        </ApplicationResponse>
    </Data>
 

      
</NewResponse>';
return $response;
    }
}


 