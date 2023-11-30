//Code for Gravity form

add_action('gform_register_init_scripts', 'add_dynamic_name_script');
function add_dynamic_name_script($form) {
    if ($form['id'] != 11) return;

    $script = '(function($){
        var firstNameInput = $("#input_11_1_3");
        var lastNameInput = $("#input_11_1_6");
        var imageContainer = $(".elementor-element-a7dccb6 .elementor-widget-container"); 
        var dynamicName = $("<div id=\'dynamic-name\' style=\'position: absolute; bottom: 20px; right: 80px; color: #3C4975;\'><span id=\'first-name\'>First</span> <span id=\'last-name\' style=\'font-weight: bold;\'>Last Name</span></div>");
        imageContainer.css("position", "relative");
        imageContainer.append(dynamicName);
        function updateName() {
            var firstName = firstNameInput.val();
            var lastName = lastNameInput.val();
            if (firstName) {
                firstName = firstName.charAt(0).toUpperCase() + firstName.slice(1);
            }
            if (lastName) {
                lastName = lastName.charAt(0).toUpperCase() + lastName.slice(1);
            }
            $("#first-name").text(firstName || "First");
            $("#last-name").text(lastName || "Last Name");
        }
        firstNameInput.on("input", updateName);
        lastNameInput.on("input", updateName);
    })(jQuery);';

    GFFormDisplay::add_init_script($form['id'], 'add_dynamic_name', GFFormDisplay::ON_PAGE_RENDER, $script);
}
