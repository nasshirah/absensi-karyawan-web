<?php ($title = 'Edit Karyawan'); ?>
<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Edit Karyawan</h5>
    <form action="<?php echo e(route('admin.karyawan.update', $user)); ?>" method="POST" class="row g-3">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">NIP</label>
        <input type="text" name="nip" class="form-control" value="<?php echo e(old('nip', $user->nip)); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Divisi</label>
        <input type="text" name="division" class="form-control" value="<?php echo e(old('division', $user->division)); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Jabatan</label>
        <input type="text" name="position" class="form-control" value="<?php echo e(old('position', $user->position)); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Telepon</label>
        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $user->phone)); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Tanggal Bergabung</label>
        <input type="date" name="join_date" class="form-control" value="<?php echo e(old('join_date', $user->join_date)); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Status</label>
        <input type="text" name="status" class="form-control" value="<?php echo e(old('status', $user->status)); ?>" placeholder="Aktif / Nonaktif">
      </div>
      <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo e(route('admin.karyawan.index')); ?>" class="btn btn-light">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.metronic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/karyawan/edit.blade.php ENDPATH**/ ?>