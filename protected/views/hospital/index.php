<?php
$this->breadcrumbs=array(
	'Hospitals',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=hospital/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Hospital_addressbookid').val(data.addressbookid);$('#Hospital_fullname').val('');
$('#Hospital_accountid').val('');$('#accpiutangname').val('');$('#Hospital_taxno').val('');
document.forms[2].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('addressdatagrid', {
                    data: {
                        'Hospitaladdress[addressbookid]': data.addressbookid
                    }});
                                        document.forms[3].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('contactdatagrid', {
                    data: {
                        'Hospitalcontact[addressbookid]': data.addressbookid
                    }
                });
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=hospital/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Hospital_addressbookid').val(data.addressbookid);
$('#Hospital_accountid').val(data.accountid);$('#accpiutangname').val(data.accountname);$('#Hospital_taxno').val(data.taxno);
$('#Hospital_fullname').val(data.fullname);if(data.recordstatus=='1')
{document.forms[1].elements[9].checked=true;}
else
{document.forms[1].elements[9].checked=false;}
document.forms[2].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('addressdatagrid', {
                    data: {
                        'Hospitaladdress[addressbookid]': data.addressbookid
                    }});
                    document.forms[3].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('contactdatagrid', {
                    data: {
                        'Hospitalcontact[addressbookid]': data.addressbookid
                    }
                });
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=hospital/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
    jQuery.ajax({
        'url': '/index.php?r=hospital/help',
        'data': {
            'id': value
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if (data.status == 'success') {
				document.getElementById('divhelp').innerHTML = data.div;
                $('#helpdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function showdetail() {
    $.fn.yiiGridView.update('inaddressdatagrid', {
                    data: {
                        'Hospitaladdress[addressbookid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
                   $.fn.yiiGridView.update('incontactdatagrid', {
                    data: {
                        'Hospitalcontact[addressbookid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    return false;
}
</script>
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#messages');
		new AjaxUpload(btnUpload, {
			action: 'index.php?r=hospital/upload',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (!(ext && /^(csv)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only CSV files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				status.text('');
				//Add uploaded file to list
				if(response==='success'){
					$.fn.yiiGridView.update('datagrid');
				} else{
					status.text(response);
				}
			}
		});		
	});
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/index.php?r=hospital/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#contacttype_name'
     ,'fallback' => Catalogsys::model()->getcatalog('entercontacttypeid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'fullname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterfullname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'permitexitname')
     ,'fallback' => Catalogsys::model()->getcatalog('entertaxno'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'accpiutangid')
     ,'fallback' => Catalogsys::model()->getcatalog('enteraccpiutangid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'contacttypeid')
     ,'fallback' => Catalogsys::model()->getcatalog('entercontacttypeid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'recordstatus')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrecordstatus'),'html'=>true),    
  ),  
));
?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model,
'hospitaladdress'=>$hospitaladdress,
'hospitalcontact'=>$hospitalcontact,
        'accpiutang'=>$accpiutang)); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divhelp"></div>
<?php $this->endWidget();?>
<h1><?php echo Catalogsys::model()->GetCatalog('hospital') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=hospital/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
  'selectableRows'=>1,
    'selectionChanged'=>'showdetail',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'addressbookid',
    ),
	array('name'=>'addressbookid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
		'fullname',
        'taxno',
		array('name'=>'accpiutangid','value'=>'($data->accpiutang!==null)?$data->accpiutang->accountname:""'),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus'
    ),
	),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inaddressdatagrid',
	'dataProvider'=>$hospitaladdress->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'addressid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid', 'visible'=>false,'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'addresstypeid', 'header'=>'Address Type Name','value'=>'$data->addresstype->addresstypename'),
		'addressname',
		'rt',
    'rw',
		array('name'=>'cityid','header'=>'City','value'=>'($data->city!==null)?$data->city->cityname:""'),
		array('name'=>'kelurahanid','header'=>'Sub Subdistrict','value'=>'($data->kelurahan!==null)?$data->kelurahan->kelurahanname:""'),
		array('name'=>'subdistrictid','header'=>'Subdistrict','value'=>'($data->subdistrict!==null)?$data->subdistrict->subdistrictname:""'),
        'phoneno',
  ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'incontactdatagrid',
	'dataProvider'=>$hospitalcontact->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'addresscontactid','visible'=>false, 'header'=>'ID','value'=>'$data->addresscontactid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid','visible'=>false, 'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'contacttypeid', 'value'=>'($data->contacttype!==null)?$data->contacttype->contacttypename:""'),
		'addresscontactname',
		'phoneno',
		'mobilephone',
		'emailaddress',
  ),
));
?>