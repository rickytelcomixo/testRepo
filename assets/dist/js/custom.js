$(document).ajaxStart(function() { Pace.restart(); });
$(document).ready(function() {

	// print page
	$("#actprint").click(function() {
		//window.print();
		var w = window.open();
		var html = $("#printable").html();
    var header = $('.content-header').find("h1").text();

		//$(w.document.body).html(html).css("fontSize", "1em");
    w.document.write('<html><head><title>'+header+'</title><link rel="stylesheet" type="text/css" href="'+getBaseUrl()+'/assets/dist/css/printStyles.css"></head><body>');
    w.document.write(html);
    w.document.write('</body></html>');
    w.document.close();
		//w.print();
    var is_chrome = Boolean(window.chrome);
    if (is_chrome) {
        setTimeout(function () { // necessary for Chrome
            w.print();
            w.close();
        }, 0);
    } else {
        w.print();
        w.close();
    };
		return false;
	});

	/*$("#product-category").select2({
	  ajax: {
	    url: "<?php echo base_url(); ?>main/liveSearch/property",
	    dataType: 'json',
	    method: 'post',
	    cache: true,
	    processResults: function (data) {
	      return {
	        results: data
	      };
	    }
	  },
	  height:'100px',
	  placeholder: "Select a Category"
	});*/

  //Datepicker
  $('#task-date').daterangepicker({
        startDate: moment(),
        singleDatePicker: true,
        showDropdowns: true,
        format: 'DD-MM-YYYY'
    });

  $('#asbod-month-year').datepicker({
      format: "mm-yyyy",
      startView: "months", 
      minViewMode: "months",
      autoclose: true,
  });

  $('#target-year, #lejer-date').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      autoclose: true,
  });

    setDateRange('daterange-taskListForm-btn','taskListForm',0,'days',false,true);

    //Initialize Select2 Elements
    $(".select2").select2();
	  $('#list-allSale').DataTable({
    	"responsive": true,
        "columnDefs": [
            { "orderable": false, "targets":9 }
            ],
        "order": [[ 1, 'asc' ]]
    });

    $('#list-allTransaction, #list-table').DataTable({
    	"responsive": true,
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });

    $('#list-subtable').DataTable({
      "responsive": true,
      "paging": false,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": true
    });

    $('#list-table-sort').DataTable({
      "responsive": true,
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "order": [[ 0, 'desc' ]]
    });
	
   
    $('#list-user').DataTable({
      "responsive": true,
        "columnDefs": [
            { "orderable": false, "targets": 5 }
            ],
        "order": [[ 0, 'asc' ]]
    });

  //Fixed on select2 bug = unable to enter and type inside the search text input
  $.fn.modal.Constructor.prototype.enforceFocus = function() {};
  
});

function setDynamicInput(formId, inputName){
  //Dynamic input field start ---------------------------------------------------------------
  var MAX_OPTIONS = 50;

  $('#'+formId)
/*      .formValidation({
          framework: 'bootstrap',
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
              question: {
                  validators: {
                      notEmpty: {
                          message: 'The question required and cannot be empty'
                      }
                  }
              },
              'option[]': {
                  validators: {
                      notEmpty: {
                          message: 'The option required and cannot be empty'
                      },
                      stringLength: {
                          max: 100,
                          message: 'The option must be less than 100 characters long'
                      }
                  }
              }
          }
      })*/

      // Add button click handler
      .on('click', '.add'+inputName+'Button', function() {
          var $template = $('#'+inputName+'Template'),
              $clone    = $template
                              .clone()
                              .removeClass('hide')
                              .removeAttr('id')
                              .insertBefore($template),
              $option   = $clone.find('[name="'+inputName+'[]"]');

          // Add new field
          //$('#'+formId).formValidation('addField', $option);
      })

      // Remove button click handler
      .on('click', '.remove'+inputName+'Button', function() {
          var $row    = $(this).parents('.form-group'),
              $option = $row.find('[name="'+inputName+'[]"]');

          // Remove element containing the option
          $row.remove();

          // Remove field
          //$('#'+formId).formValidation('removeField', $option);
      })

      // Called after adding new field
      .on('added.field.fv', function(e, data) {
          // data.field   --> The field name
          // data.element --> The new field element
          // data.options --> The new field options

          if (data.field === 'option[]') {
              if ($('#'+formId).find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
                  $('#'+formId).find('.add'+inputName+'Button').attr('disabled', 'disabled');
              }
          }
      })

      // Called after removing the field
      .on('removed.field.fv', function(e, data) {
         if (data.field === 'option[]') {
              if ($('#'+formId).find(':visible[name="option[]"]').length < MAX_OPTIONS) {
                  $('#'+formId).find('.add'+inputName+'Button').removeAttr('disabled');
              }
          }
      });
//Dynamic input field end ------------------------------------------------------------------
}

//diff = no of days, months or years  
//diffType = days, months, years
//useRange = set from php controller passed to input values
function setDateRange(elementId, form, diff, diffType, singleDate, useRange){
  //Date range start
  $('#'+elementId).daterangepicker(
      {
        //showWeekNumbers: true,
        singleDatePicker: singleDate,
        showDropdowns: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(diff, diffType),
        endDate: moment(),
        "opens": "center"
      },
      function (start, end) {
        $('#'+elementId+' span').html(start.format('D/MM/YYYY') + ' - ' + end.format('D/MM/YYYY'));
      }
  );
  $('#'+elementId).on('apply.daterangepicker', function(ev, picker) {
    $("#start-date").val(picker.startDate.format('YYYY-MM-DD'));
    $("#end-date").val(picker.endDate.format('YYYY-MM-DD'));
    $('#'+form).submit();
  });
    
  var $_GET = getQueryParams(document.location.search);
  //change the selected date range of that picker
  if($_GET['start-date'] != null && $_GET['end-date'] != null || (typeof(useRange) != 'undefined' && useRange)){
    if(typeof(useRange) != 'undefined' && useRange){
      setSelectedDateRange(elementId, form, $("#start-date").val(),$("#end-date").val(),singleDate);
      cb(moment($("#start-date").val()), moment($("#end-date").val()));
    } else {
      setSelectedDateRange(elementId, form, $_GET['start-date'],$_GET['end-date'],singleDate);
      cb(moment($_GET['start-date']), moment($_GET['end-date']));
    }
  } else {
      cb(moment().subtract(diff, diffType), moment());
  }
  function cb(start, end) {
        $('#'+elementId+' span').html(start.format('D/MM/YYYY') + ' - ' + end.format('D/MM/YYYY'));
  }
  //Date range end
}

function setSelectedDateRange(elementId, form, startDate, endDate, singleDate){
  $('#'+elementId).daterangepicker(
      {
        //showWeekNumbers: true,
        singleDatePicker: singleDate,
        showDropdowns: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Last 3 Months': [moment().subtract(3, 'months').startOf('month'), moment().endOf('month')],
          'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
          'This Year': [moment().startOf('year'), moment().endOf('year')],
          'Last Year': [moment().subtract(1, 'years').startOf('month'), moment().subtract(1, 'years').endOf('month')]
        },
        startDate: moment(startDate),
        endDate: moment(endDate),
        "opens": "center"
      },
      function (start, end) {
        $('#'+elementId+' span').html(start.format('D/MM/YYYY') + ' - ' + end.format('D/MM/YYYY'));
      }
  );

  $('#'+elementId).on('apply.daterangepicker', function(ev, picker) {
    $("#start-date").val(picker.startDate.format('YYYY-MM-DD'));
    $("#end-date").val(picker.endDate.format('YYYY-MM-DD'));
    $('#'+form).submit();
  });
}

function getQueryParams(qs) {
    qs = qs.split("+").join(" ");
    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }

    return params;
}

function getDropdownCallback(id, ddlTargetId){
	param = {};
	param['id'] = id;
	$.post(getBaseUrl()+'/ajax/getDropdownList', param, function( data ) {
		if(data['status'] == 'success'){
		  $('#'+ddlTargetId).html(data['html']);
		}
	},'json');
}

function getInputListCallback(id, ddlTargetId){
  param = {};
  param['id'] = id;
  $.post(getBaseUrl()+'/ajax/getInputList', param, function( data ) {
    if(data['status'] == 'success'){
      $('#'+ddlTargetId).html(data['html']);
    }
  },'json');
}

function doEditForm(form, id, option, subid, subid2){
	param = {};
	param['form'] = form;
	param['id'] = id;
  param['option'] = "";
  param['subid'] = "";
  if(option != null){
    param['option'] = option;
  }
  if(subid != null){
    param['subid'] = subid;
  }
   if(subid2 != null){
    param['subid2'] = subid2;
  }

  if(form == 'Report'){
    param['startDate'] = $("#start-date").val();
    param['endDate'] = $("#end-date").val();
  }

	var formHtml = '';
	$.post(getBaseUrl()+'/ajax/getForm', param, function( data ) {
		if(data['status'] == 'success'){
		  formHtml = data['form'];
		}

    if(option.toLowerCase() == 'delete'){
		  var myModal = $("#infoModal");
    } else {
      var myModal = $("#formModal");
    }

		var title = ucfirst(option.toLowerCase()) +' '+ param['form'];
		myModal.find('.modal-title').text(title);
		myModal.find('.modal-body').html(formHtml);
		

    if(option.toLowerCase() == 'delete'){
      if(form == "Items"){
        //$("#"+subid).parent().parent().hide();
        doEditForm("Minit Mesyuarat", subid, "Edit");
      }
    } else {
      myModal.modal('show');
    }
	},'json');
}

function ucfirst(str) {
    var firstLetter = str.slice(0,1);
    return firstLetter.toUpperCase() + str.substring(1);
}

function getTableList(list, userid, productid, accountid){
	var $_GET = getQueryParams(document.location.search);
	param = {};
	param['list'] = list;
	param['userid'] = userid;
	param['productid'] = productid;
  param['accountid'] = accountid;
	param['startDate'] = $_GET['start-date'];
	param['endDate'] = $_GET['end-date'];
	var formHtml = '';
	$.post(getBaseUrl()+'/ajax/getTable', param, function( data ) {
		if(data['status'] == 'success'){
		  formHtml = data['form'];
		}

		var myModal = $("#listModal");
		//var title = param['list'];

		myModal.find('.modal-title').text(list);
		myModal.find('.modal-body').html(formHtml);
		myModal.modal('show');

    //once the modal has been shown
    myModal.on("shown.bs.modal", function() {
      if(list == 'Sale Details'){
       var tableId = "list-allSale-details";
      }
      //Get the datatable which has previously been initialized
      var dataTable= $("#"+tableId).DataTable();
      //recalculate the dimensions
      dataTable.columns.adjust().responsive.recalc();
    });

	},'json');
}


function getBaseUrl(){
	var getUrl = window.location;
	var urlArr = getUrl.pathname.split('/');
	var baseUrl = getUrl.protocol + "//" + getUrl.host;
	if(getUrl.host == 'localhost' || getUrl.host == '127.0.0.1' || getUrl.host == '10.8.6.139'){
		baseUrl += '/'+urlArr[1];
	}
	return baseUrl;
}

$(document)  
  .on('show.bs.modal', '.modal', function(event) {
    $(this).appendTo($('body'));
  })
  .on('shown.bs.modal', '.modal.in', function(event) {
    setModalsAndBackdropsOrder();
  })
  .on('hidden.bs.modal', '.modal', function(event) {
    setModalsAndBackdropsOrder();
  });


function setModalsAndBackdropsOrder() {  
  var modalZIndex = 1040;
  $('.modal.in').each(function(index) {
    var $modal = $(this);
    modalZIndex++;
    $modal.css('zIndex', modalZIndex);
    $modal.next('.modal-backdrop.in').addClass('hidden').css('zIndex', modalZIndex - 1);
});
  $('.modal.in:visible:last').focus().next('.modal-backdrop.in').removeClass('hidden');
}

$(function () {
  //bootstrap WYSIHTML5 - text editor
  $(".textarea").wysihtml5();
});

$(function () {
  $('[data-toggle="popover"]').popover()
})

function updateBatchTitle(){
  var cb = $("input[name='batch_type']:checked").val();
  window.location = getBaseUrl()+'/transactions/adjustment/updateBatchTitle/'+$('#batch-id').val()+'/'+cb+'/'+$("#batch-title").val();
}


//Show current balance for selected acount in Transaction
function showCurrentBalance(id){
  $("#"+id).change(function(){
    //alert($(this).val());
    if($(this).val() == ''){
      $("#"+id).hide(400);
    } else {
      param = {};
      param['id'] = $(this).val();
      $("#"+id+"-balance").show(400).find('span').text('Loading...');
      $.post(getBaseUrl()+'/ajax/getUserBalance', param, function( data ) {
        if(data['status'] == 'success'){
          $("#"+id+"-balance").show(400).find('span').text(data['balance']);
        } else {
          $("#"+id+"-balance").show(400).find('span').text('Not available.');
        }
      },'json');
    }
  });
}