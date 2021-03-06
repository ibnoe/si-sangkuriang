<?php
/* @var $this DaftarKelasSiswaController */
/* @var $model DaftarKelasSiswa */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'daftar-kelas-siswa-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_daftar_kelas'); ?>
		<?php echo $form->dropDownList($model,'id_daftar_kelas',$model->getDaftarKelas(),array('empty'=>'--Pilih Kelas--')); ?>
		<?php echo $form->error($model,'id_daftar_kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nis'); ?>
		<?php echo $form->dropDownList($model,'nis',$model->getSiswa(),array('empty'=>'--Pilih siswa--')); ?>
		<?php echo $form->error($model,'nis'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->