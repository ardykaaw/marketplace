<div class="col-md-8">
  <form action="{{ route('profile.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ optional(Auth::user())->name }}" required>
      </div>
      <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ optional(Auth::user())->email }}" required>
      </div>
      <div class="mb-3">
          <label for="address" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ optional(Auth::user())->address }}" placeholder="Tambahkan alamat" required>
      </div>
      <div class="buttonContactUs">
          <button type="submit" class="btn btn-primary">Perbarui Profil</button>
      </div>
  </form>
</div>