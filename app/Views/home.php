<?=$this->extend("_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid p-0">

  <!-- SEARCH HERO -->
  <section class="search-hero">
    <div class="container">
      <h1>Search Rental Properties Near You</h1>
      <p>Rooms • Flats • Apartments • Buildings</p>

      <div class="search-panel">
        <input type="text" placeholder="City / Area / Landmark">
        <select>
          <option>Property Type</option>
          <option>Room</option>
          <option>Flat</option>
          <option>Apartment</option>
          <option>Building</option>
        </select>
        <select>
          <option>Budget</option>
          <option>Below ₹5,000</option>
          <option>₹5,000 - ₹10,000</option>
          <option>₹10,000+</option>
        </select>
        <button>Search</button>
      </div>
    </div>
  </section>

  <!-- PROPERTY TYPES -->
  <section class="py-5">
    <div class="container">
      <h3 class="mb-4">Browse by Property Type</h3>

      <div class="row g-4">

        <div class="col-md-3">
          <div class="type-card">
            <img src="<?= base_url('assets/admin/images/1bhk.png') ?>">
            <h5>Rooms</h5>
            <p>Affordable single & shared rooms</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="type-card">
            <img src="<?= base_url('assets/admin/images/logo2a.png') ?>">
            <h5>Flats</h5>
            <p>1 BHK / 2 BHK flats</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="type-card">
            <img src="<?= base_url('assets/admin/images/apartement1.png') ?>">
            <h5>Apartments</h5>
            <p>Gated & furnished apartments</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="type-card">
            <img src="<?= base_url('assets/admin/images/apartment.png') ?>">
            <h5>Buildings</h5>
            <p>Commercial & residential buildings</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FEATURED LISTINGS -->
  <section class="py-5 bg-light">
    <div class="container">
      <h3 class="mb-4">Featured Rentals</h3>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="list-card">
            <img src="<?= base_url('assets/admin/images/room.jpeg') ?>">
            <div class="info">
              <span class="pill">Room</span>
              <h5>Single Room Near Market</h5>
              <p>Patna</p>
              <b>₹4,500 / month</b>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
<style>
  
.search-hero {
  background: 
    /* linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), */
    url("<?= base_url('assets/admin/images/logo2.png') ?>") no-repeat center center;
  
  background-size: cover;
  padding: 100px 0;
  color: #0b0808;
  text-align: center;
}

.search-hero h1{
  font-size:38px;
  font-weight:600;
}

.search-panel{
  background:url("<?= base_url('assets/admin/images/logo2.png') ?>") no-repeat center center;
  margin-top:30px;
  padding:20px;
  border-radius:12px;
  display:flex;
  gap:10px;
  box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.search-panel input,
.search-panel select{
  flex:1;
  padding:12px;
  border:1px solid #e5e7eb;
  border-radius:8px;
}

.search-panel button{
  background:#2563eb;
  color:#fff;
  border:none;
  padding:12px 30px;
  border-radius:8px;
}

/* TYPE CARDS */
.type-card{
  background:#fff;
  border-radius:14px;
  padding:15px;
  text-align:center;
  box-shadow:0 10px 20px rgba(0,0,0,0.1);
}

.type-card img{
  width:100%;
  height:160px;
  object-fit:cover;
  border-radius:10px;
}

.type-card h5{
  margin-top:15px;
}

/* LISTING */
.list-card{
  background:#fff;
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.list-card img{
  width:100%;
  height:220px;
  object-fit:cover;
}

.list-card .info{
  padding:15px;
}

.pill{
  background:#22c55e;
  color:#fff;
  padding:4px 10px;
  border-radius:20px;
  font-size:12px;
}
</style>
<?=$this->endSection()?>