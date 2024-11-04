"use strict";

// Class definition
var KTCreateAccount = function () {
	// Elements
	var modal;	
	var modalEl;

	var stepper;
	var form;
	var formSubmitButton;
	var formContinueButton;

	// Variables
	var stepperObj;
	var validations = [];

	// Private Functions
	var initStepper = function () {
		// Initialize Stepper
		stepperObj = new KTStepper(stepper);

		// Stepper change event
		stepperObj.on('kt.stepper.changed', function (stepper) {
			if (stepperObj.getCurrentStepIndex() === 5) {
				formSubmitButton.classList.remove('d-none');
				formSubmitButton.classList.add('d-inline-block');
				formContinueButton.classList.add('d-none');
			} else if (stepperObj.getCurrentStepIndex() === 6) {
				formSubmitButton.classList.add('d-none');
				formContinueButton.classList.add('d-none');
			} else {
				formSubmitButton.classList.remove('d-inline-block');
				formSubmitButton.classList.remove('d-none');
				formContinueButton.classList.remove('d-none');
			}
		});

		// Validation before going to next page
		stepperObj.on('kt.stepper.next', function (stepper) {
			console.log('stepper.next');

			// Validate form before change stepper step
			var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						stepper.goNext();

						KTUtil.scrollTop();
					} else {
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-light"
							}
						}).then(function () {
							KTUtil.scrollTop();
						});
					}
				});
			} else {
				stepper.goNext();

				KTUtil.scrollTop();
			}
		});

		// Prev event
		stepperObj.on('kt.stepper.previous', function (stepper) {
			console.log('stepper.previous');

			stepper.goPrevious();
			KTUtil.scrollTop();
		});
	}

	var handleForm = function() {
		formSubmitButton.addEventListener('click', function (e) {
			// Validate form before change stepper step
			var validator = validations[3]; // get validator for last form

			validator.validate().then(function (status) {
				console.log('validated!');

				if (status == 'Valid') {
					// Prevent default button action
					e.preventDefault();

					// Disable button to avoid multiple click 
					formSubmitButton.disabled = true;

					// Show loading indication
					formSubmitButton.setAttribute('data-kt-indicator', 'on');
					 // Check axios library docs: https://axios-http.com/docs/intro
					 axios.post(formSubmitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response) {
                           
                            if(response.data.error == false){
                                form.reset();
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toastr-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                                toastr.success("Beneficiary Assessment stored succesfully", "Success");
                                window.location.href = response.data.editUrl;
                            }
                            else{
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toastr-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                                toastr.error(response.data.message, "Error");
                            }
                            
                        } else {
                            toastr.options = {
                                "closeButton": false,
                                "debug": true,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toastr-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                              };
                              
                              toastr.error("Please address the highlighted errors", "Error");
                        }
                    }).catch(function (error) {
                        toastr.options = {
                            "closeButton": false,
                            "debug": true,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                          };
                          
                          toastr.error("Please address the highlighted errors", "Error");   
                    }).then(() => {
                        // Hide loading indication
                        formSubmitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        formSubmitButton.disabled = false;
                    });
					// Simulate form submission
					setTimeout(function() {
						// Hide loading indication
						formSubmitButton.removeAttribute('data-kt-indicator');

						// Enable button
						formSubmitButton.disabled = false;

						stepperObj.goNext();
					}, 2000);
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Expiry month. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="card_expiry_month"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validations[3].revalidateField('card_expiry_month');
        });

		// Expiry year. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="card_expiry_year"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validations[3].revalidateField('card_expiry_year');
        });

		// Expiry year. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="business_type"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validations[2].revalidateField('business_type');
        });
	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					project: {
						validators: {
							notEmpty: {
								message: 'Project is required'
							},
							
						}
					},
					date: {
						validators: {
							notEmpty: {
								message: 'Date  is required'
							}
						}
					},
					province: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					district: {
						validators: {
							notEmpty: {
								message: 'District is required'
							}
						}
					},
					tehsil: {
						validators: {
							notEmpty: {
								message: 'Tehsil is required'
							}
						}
					},
					uc: {
						validators: {
							notEmpty: {
								message: 'UC is required'
							}
						}
					},
					village: {
						validators: {
							notEmpty: {
								message: 'UC is required'
							}
						}
					},
					
				
				
					
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 2
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					name_of_beneficiary: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					guardian: {
						validators: {
							notEmpty: {
								message: 'Guardian is required'
							}
						}
					},
					age: {
						validators: {
							notEmpty: {
								message: 'Age is required'
							},
							numeric: {
                                message: 'Age  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Age must be a positive number'
                            }
						}
					},
					beneficiary_contact: {
						validators: {
							notEmpty: {
								message: 'Contact is required'
							}
						}
					},
					contact_number: {
						validators: {
							notEmpty: {
								message: 'Contact Number is required'
							}
						}
					},
					hh_segregate: {
						validators: {
							notEmpty: {
								message: 'HH Segregate is required'
							},
							
						}
					},
					hh_girls: {
						validators: {
							notEmpty: {
								message: 'HH Girls is required'
							},
							numeric: {
                                message: 'HH Girls  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Girls must be a positive number'
                            }
						}
					},
					hh_boys: {
						validators: {
							notEmpty: {
								message: 'HH Boys is required'
							},
							numeric: {
                                message: 'HH Boys  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Boys must be a positive number'
                            }
						}
					},
					cnic_beneficiary: {
						validators: {
							notEmpty: {
								message: 'CNIC Beneficary is required'
							}
						}
					},
					cnic_spouse: {
						validators: {
							notEmpty: {
								message: 'Cnic Spouse is required'
							}
						}
					},
					cnic_issuance: {
						validators: {
							notEmpty: {
								message: 'CNIC Issue date is required'
							}
						}
					},
					cnic_expiry: {
						validators: {
							notEmpty: {
								message: 'CNIC expiry is required'
							}
						}
					},
					recieve_cash: {
						validators: {
							notEmpty: {
								message: 'Reveive Cash is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 3
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					hh_monthly_income: {
						validators: {
							notEmpty: {
								message: 'HH Monthly Income required'
							},
							numeric: {
                                message: 'HH Monthly Income  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Monthly Income must be a positive number'
                            }
						}
					},
					hh_source_income: {
						validators: {
							notEmpty: {
								message: 'HH Source Income is required'
							}
						}
					},
					hh_person_earned: {
						validators: {
							notEmpty: {
								message: 'HH Person Earned is required'
							},
							numeric: {
                                message: 'HH Person Earned  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Person Earned must be a positive number'
                            }
						}
					},
					hh_outstanding_debt: {
						validators: {
							notEmpty: {
								message: 'hh outstanding Debt is required'
							},
							numeric: {
                                message: 'HH Outstanding Debt  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Outstanding Debt must be a positive number'
                            }
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 4
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'house_demage': {
						validators: {
							notEmpty: {
								message: 'house Damege is required'
							},
							numeric: {
                                message: 'House Demage is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'House Demagemust be a positive number'
                            }
						}
					},
					'hh_minority': {
						validators: {
							notEmpty: {
								message: 'Card member is required'
							},
							numeric: {
                                message: 'HH Minority  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Minority must be a positive number'
                            }
						}
					},
					'reffered_tls': {
						validators: {
							notEmpty: {
								message: 'Reffered is required'
							}
						}
					},
					'hh_died_female': {
						validators: {
							notEmpty: {
								message: 'HH Died Female is required'
							},
							numeric: {
                                message: 'HH Died Female  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Died Female must be a positive number'
                            }
						}
					},
					'hh_died_male': {
						validators: {
							notEmpty: {
								message: 'HH Died Male is required'
							},
							numeric: {
                                message: 'HH Died Male  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Died Male must be a positive number'
                            }
							
						}
					},
					'hh_injured_female': {
						validators: {
							notEmpty: {
								message: 'HH Injured Male is required'
							},
							numeric: {
                                message: 'HH Injured Female  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Injured Female must be a positive number'
                            }
							
						}
					},
					'hh_injured_male': {
						validators: {
							notEmpty: {
								message: 'HH Injured Female is required'
							},
							numeric: {
                                message: 'HH Injured Female  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Injured Female must be a positive number'
                            }
							
						}
					},
					'hh_disabled_girls': {
						validators: {
							notEmpty: {
								message: 'HH Disabled Girls is required'
							},
							numeric: {
                                message: 'HH Disabled Girls  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Disabled Girls must be a positive number'
                            }
							
						}
					},
					'hh_disabled_boys': {
						validators: {
							notEmpty: {
								message: 'HH Disabled Boys is required'
							},
							numeric: {
                                message: 'HH Disabled Boys  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Disabled Boys must be a positive number'
                            }
							
						}
					},
					'hh_disabled_men': {
						validators: {
							notEmpty: {
								message: 'HH Disabled Men is required'
							},
							numeric: {
                                message: 'HH Disabled Men  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Disabled Men must be a positive number'
                            }
							
						}
					},
					'hh_disabled_women': {
						validators: {
							notEmpty: {
								message: 'HH Disabled Women is required'
							},
							numeric: {
                                message: 'HH Disabled Women  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'HH Disabled Women must be a positive number'
                            }
							
						}
					},
					'large_animals': {
						validators: {
							notEmpty: {
								message: 'Large Animal is required'
							},
							numeric: {
                                message: 'Large Animal  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Large Animal must be a positive number'
                            }
						}
					},
					'small_animals': {
						validators: {
							notEmpty: {
								message: 'Small Animal is required'
							},
							numeric: {
                                message: 'Small Animal  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Small Animal must be a positive number'
                            }
						}
					},
					'orphan_girls': {
						validators: {
							notEmpty: {
								message: 'Orphan Girls is required'
							},
							numeric: {
                                message: 'Orphan Girls  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Orphan Girls must be a positive number'
                            }
						}
					},
					'orphan_boys': {
						validators: {
							notEmpty: {
								message: 'Orphan Boys is required'
							},
							numeric: {
                                message: 'Orphan Boys  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Orphan Boys must be a positive number'
                            }
						}
					},
					'land_destroyed': {
						validators: {
							notEmpty: {
								message: 'Land Destroyed is required'
							},
							numeric: {
                                message: 'Land Destroyed  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Land Destroyed must be a positive number'
                            }
						}
					},
					'widows_count': {
						validators: {
							notEmpty: {
								message: 'Widows Count is required'
							},
							numeric: {
                                message: 'Widows Count  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Widows Count must be a positive number'
                            }
						}
					},
					'pregnant_women': {
						validators: {
							notEmpty: {
								message: 'Pragnent Women is required'
							},
							numeric: {
                                message: 'Pragnent Women  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Pragnent Women must be a positive number'
                            }
						}
					},
					'meals_per_day': {
						validators: {
							notEmpty: {
								message: 'Meal Take per day is required'
							},
							numeric: {
                                message: 'Must be number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Must be a positive number'
                            }
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 5
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					cash_assistance: {
						validators: {
							notEmpty: {
								message: 'Cash Assistance required'
							}
						}
					},
					assessment_officer: {
						validators: {
							notEmpty: {
								message: 'Assessment Officer is required'
							}
						}
					},
					beneficiary_name: {
						validators: {
							notEmpty: {
								message: 'Beneficiary Name is required'
							}
						}
					},
					vc_representative: {
						validators: {
							notEmpty: {
								message: 'VC epresentative is required'
							}
						}
					},
					vc_representative: {
						validators: {
							notEmpty: {
								message: 'VC epresentative is required'
							}
						}
					},
					recieve_cash_amount: {
						validators: {
							numeric: {
                                message: 'Boys acheivement  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Boys acheivement must be a positive number'
                            }
						}
					},
					attachment: {
						validators: {
							notEmpty: {
								message: 'Attachment is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

	}

	return {
		// Public Functions
		init: function () {
			// Elements
			modalEl = document.querySelector('#kt_modal_create_account');

			if ( modalEl ) {
				modal = new bootstrap.Modal(modalEl);	
			}					

			stepper = document.querySelector('#kt_create_account_stepper');

			if ( !stepper ) {
				return;
			}

			form = stepper.querySelector('#kt_create_account_form');
			formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
			formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');

			initStepper();
			initValidation();
			handleForm();
		}
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTCreateAccount.init();
});