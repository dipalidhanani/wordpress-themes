function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function mfn_mce_submit() {

	var output;
	var shortcode = document.getElementById('shortcode').value;
	
	switch( shortcode ) {
		case 0:
		case "0":
			tinyMCEPopup.close();
			break;
	
		// ************************* general **********************
		case "blockquote":
			output = "[" + shortcode + " photo=\"\" author=\"\" company=\"\" link=\"\" target=\"_blank\"]" +
				" Insert your content here " +
				"[/" + shortcode + "]";
			break;
			
		case "button":
			output = "[" + shortcode + " title=\"\" link=\"\" target=\"_blank\" size=\"\" color=\"\" class=\"\"]";
			break;
			
		case "divider":
			output = "[" + shortcode + " height=\"30\" line=\"1\"]";
			break;
			
		case "highlight":
			output = "[" + shortcode + " background=\"\" color=\"\"]" +
				" Insert your content here " +
				"[/" + shortcode + "]";
			break;
			
		case "ico":
			output = "[" + shortcode + " type=\"\"]";
			break;	
			
		case "icon_list":
			output = "[" + shortcode + " title=\"\" image=\"\" icon=\"\"]" +
				" Insert your content here " +
				"[/" + shortcode + "]";
			break;

		case "image":
			output = "[" + shortcode + " src=\"\" align=\"\" caption=\"\" link=\"\" link_type=\"\" target=\"\" alt=\"\"]";
			break;
			
		case "table":
			output = "<table><thead><tr><th>Column 1 heading</th><th>Column 2 heading</th><th>Column 3 heading</th></tr></thead><tbody><tr><td>Row 1 col 1 content</td><td>Row 1 col 2 content</td><td>Row 1 col 3 content</td></tr><tr><td>Row 2 col 1 content</td><td>Row 2 col 2 content</td><td>Row 2 col 3 content</td></tr></tbody></table>";
			break;	

		case "vimeo":
			output = "[" + shortcode + " video=\"1084537\" width=\"700\" height=\"400\"]";
			break;
			
		case "youtube":
			output = "[" + shortcode + " video=\"YE7VzlLtp-4\" width=\"700\" height=\"420\"]";
			break;
	
		default:
			output = "[" + shortcode + "] Insert your content here [/" + shortcode + "]";
	}
	

	if (window.tinyMCE) {
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent',false, output);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return true;
}