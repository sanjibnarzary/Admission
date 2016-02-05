 tinymce.init({
			selector: 'textarea',
			height: 300,
		  plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table contextmenu paste code'
		  ],
		  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
	  });

 $(document).ready(function(){
	 $("input[name$='paymentMode']").click(function(){
		 var mode = $(this).val();
		 if(mode == 'ONLINE'){
			 //$("div#ddMode").disable();
			 $("div.paymentMode").hide();
			 $("#onlineMode").show();
		 }
		 else if(mode == 'DD'){
			 //$("div#onlineMode").remove();
			 //$("div#ddMode").addEle;
			 $("div.paymentMode").hide();
			 $("#ddMode").show();
		 }
		 else{}
	 });
 });