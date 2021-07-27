jQuery(document).ready(function($){

			 let custom_uploader;


             for(let i = 1; i < 5; i++) {

                $('.my_upl_button' + i).click(function(e) {

                e.preventDefault();

                let currentfile = document.getElementsByClassName('image_url'+i).value;
                let currentID = document.getElementsByClassName('image_id'+i).value;			

                        //If the uploader object has already been created, reopen the dialog
                        if (custom_uploader) {
                                custom_uploader.open();
                                return;
                        } 

                        //Extend the wp.media object
                        custom_uploader = wp.media.frames.file_frame = wp.media({
                                title: 'Choose File',
                                button: {
                                        text: 'Choose File'
                                },
                                multiple: false
                        });

                        //When a file is selected, grab the URL and set it as the text field's value
                        custom_uploader.on('select', function() {

                            //assign current values to the hidden fields
                            if(currentID != ''){
                                $('.image_id'+i).val(currentID);									
                            }
                            
                            if(currentfile != ''){											 
                                $( '.image_url'+i).val(currentfile);
                            }

                            var selection = custom_uploader.state().get('selection').toJSON();
                            
                            selection.map( function(attachment){
                                //update id's field
                                $('.image_id'+i).val(attachment.id);

                                //update urls's field
                                $( '.image_url'+i).val(attachment.url);					

                            });

                            custom_uploader = null;
                            });


                        //Open the uploader dialog
                        custom_uploader.open();

                });
            }

});
jQuery(document).ready(function($){

            for(let i = 1; i < 5; i++) {
				$('.my_clear_button'+i).click(function(e) {

				$( '.image_id'+i).val("");
				$( '.image_url'+i ).val("");

				return;
					 
			});
        }

});