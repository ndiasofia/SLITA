<h2 class="font-bold text-2xl my-4">Generate Token</h2>
<form action="<?= base_url('pembayaran/genToken') ?>" id="form-generate-token" method="POST" show-validation>
    <div class="form-control">
        <label for="kodebank" class="label">
            <span class="label-text label-required">Kode Bank</span>
        </label>
        <input type="text" name="kodebank" id="kodebank" class="input input-bordered" placeholder="masukkan kode bank disini">
    </div>
    <div class="form-control">
        <label for="namabank" class="label">
            <span class="label-text label-required">Nama Bank</span>
        </label>
        <input type="text" name="namabank" id="namabank" class="input input-bordered" placeholder="masukkan nama bank disini">
    </div>
</form>

<div class="modal-action">
    <button type="submit" form="form-generate-token" class="btn btn-primary">Generate</button>
    <label for="modal-global" class="btn">Batal</label>
</div>
<div class="form-control">
    <label for="token" class="label">
        <span class="label-text">Hasil Generate</span>
    </label>
    <textarea id="token" class="input input-bordered" rows="5" style="height:100%;"></textarea>
</div>