<?php
    class qa_featured_admin {

	function option_default($option) {
		
	    switch($option) {
		case 'featured_question_css':
		    return '
			.qa-q-list-item-featured {
				background-color:#FFC;
			}
			';
		default:
		    return null;				
	    }
		
	}
        
        function allow_template($template)
        {
            return ($template!='admin');
        }       
            
        function admin_form(&$qa_content)
        {                       
                            
        // Process form input
            
            $ok = null;
            
            if (qa_clicked('featured_questions_save')) {
                qa_opt('featured_questions_list',qa_post_text('featured_questions_list'));
                qa_opt('featured_question_css',qa_post_text('featured_question_css'));
		
		        $ok = qa_lang('admin/options_saved');
            }
			elseif (qa_clicked('donate_zhao_guangyue')) {
				qa_redirect_raw('https://paypal.me/guangyuezhao');
		    }

  
        // Create the form for display
            
            $fields = array();
    
	    $fields[] = array(
			'label' => 'Featured question ids( separate question id numbers with commas (e.g. 123,456) )',
			'tags' => 'NAME="featured_questions_list"',
			'value' => qa_opt('featured_questions_list'),
			'type' => 'text',
	    );
	    $fields[] = array(
			'label' => 'Custom css:',
			'tags' => 'NAME="featured_question_css"',
			'value' => qa_opt('featured_question_css'),
			'rows' => 10,
			'type' => 'textarea',
        );
		$fields[] = array(
			'label' => '<span style="color:#f90; font-size:16px; text-align:center;">Hope you can donate <strong>$1</strong> for my work!</br> Thanks very much!</span>',
			'type' => 'custom',
			'tags' => 'NAME="hope_donate"',
        );
		return array(           
			'ok' => ($ok && !isset($error)) ? $ok : null,
				
			'fields' => $fields,
		 
			'buttons' => array(
				array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'NAME="featured_questions_save"',
				),
				array(
					'label' => 'Donate',
					'tags' => 'NAME="donate_zhao_guangyue"',
				)
			),
		);
        }
    }

