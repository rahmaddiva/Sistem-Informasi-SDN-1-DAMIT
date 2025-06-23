<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    .settings-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .settings-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        text-align: center;
    }

    .settings-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 20px 25px;
        border: none;
    }

    .card-header-custom h5 {
        margin: 0;
        display: flex;
        align-items: center;
        font-weight: 600;
    }

    .card-header-custom i {
        margin-right: 10px;
        font-size: 20px;
    }

    .card-body-custom {
        padding: 30px;
    }

    .form-group-custom {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label-custom {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .form-label-custom i {
        margin-right: 8px;
        color: #6c757d;
        width: 16px;
    }

    .form-control-custom {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control-custom:focus {
        border-color: #4facfe;
        box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
        background: white;
    }

    .form-control-readonly {
        background: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        z-index: 10;
    }

    .password-toggle:hover {
        color: #495057;
    }

    .password-input-wrapper {
        position: relative;
    }

    .divider-custom {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, transparent, #dee2e6, transparent);
        margin: 30px 0;
    }

    .password-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        margin-top: 20px;
    }

    .password-section h6 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .password-section h6 i {
        margin-right: 10px;
        color: #e74c3c;
    }

    .btn-custom {
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary-custom {
        background: #6c757d;
        color: white;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .alert-info-custom {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 15px;
    }

    .password-strength {
        height: 4px;
        border-radius: 2px;
        background: #e9ecef;
        overflow: hidden;
        margin-top: 5px;
    }

    .password-strength-bar {
        height: 100%;
        transition: all 0.3s ease;
        width: 0%;
    }

    .strength-weak {
        background: #dc3545;
        width: 25%;
    }

    .strength-fair {
        background: #fd7e14;
        width: 50%;
    }

    .strength-good {
        background: #ffc107;
        width: 75%;
    }

    .strength-strong {
        background: #28a745;
        width: 100%;
    }

    .password-requirements {
        font-size: 12px;
        color: #6c757d;
        margin-top: 8px;
    }

    .requirement {
        display: flex;
        align-items: center;
        margin-bottom: 4px;
    }

    .requirement i {
        margin-right: 6px;
        font-size: 10px;
    }

    .requirement.valid {
        color: #28a745;
    }

    .requirement.invalid {
        color: #dc3545;
    }

    @media (max-width: 768px) {
        .settings-container {
            margin: 0 15px;
        }

        .card-body-custom {
            padding: 20px;
        }

        .settings-header {
            padding: 20px;
        }
    }
</style>

<div class="content-wrapper">
    <div class="settings-container">
        <!-- Header Section -->
        <div class="settings-header">
            <?php if (!empty($siswa['foto']) && file_exists(FCPATH . 'foto_siswa/' . $siswa['foto'])) : ?>
                <img src="<?= base_url('foto_siswa/' . $siswa['foto']) ?>" alt="Foto User" class="user-avatar rounded-circle" />
            <?php else : ?>
                <img src="<?= base_url('assets/img/default-user.png') ?>" alt="Foto Default" class="user-avatar rounded-circle" />
            <?php endif; ?>
            <h3 class="mb-2">Pengaturan Akun</h3>
            <p class="mb-0 opacity-75">Kelola informasi dan keamanan akun Anda</p>
        </div>

        <!-- Alert for Success/Error Messages -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-custom">
                <i class="mdi mdi-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-custom">
                <i class="mdi mdi-alert-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Profile Information Card -->
        <div class="settings-card">
            <div class="card-header-custom">
                <h5>
                    <i class="mdi mdi-account-circle"></i>
                    Informasi Profil
                </h5>
            </div>
            <div class="card-body-custom">
                <div class="alert-info-custom alert-custom">
                    <i class="mdi mdi-information me-2"></i>
                    Informasi profil ini hanya dapat diubah oleh administrator sistem.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="mdi mdi-account"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" class="form-control form-control-custom form-control-readonly"
                                value="<?= esc($siswa['nama'] ?? $user['nama']) ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="mdi mdi-account-key"></i>
                                Username
                            </label>
                            <input type="text" class="form-control form-control-custom form-control-readonly"
                                value="<?= esc($user['username']) ?>" readonly>
                        </div>
                    </div>
                </div>

                <?php if (isset($siswa)) : ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    <i class="mdi mdi-card-account-details"></i>
                                    NIS/NISN
                                </label>
                                <input type="text" class="form-control form-control-custom form-control-readonly"
                                    value="<?= esc($siswa['nisn'] ?? '-') ?>" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    <i class="mdi mdi-google-classroom"></i>
                                    Kelas
                                </label>
                                <input type="text" class="form-control form-control-custom form-control-readonly"
                                    value="<?= esc($siswa['nama_kelas'] ?? '-') ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="mdi mdi-account-tie"></i>
                                ID Guru (Wali Kelas)
                            </label>
                            <input type="text" class="form-control form-control-custom form-control-readonly"
                                value="<?= esc($siswa['nama_guru'] ?? '-') ?>" readonly>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Password Change Card -->
        <div class="settings-card">
            <div class="card-header-custom">
                <h5>
                    <i class="mdi mdi-lock-reset"></i>
                    Keamanan Akun
                </h5>
            </div>
            <div class="card-body-custom">
                <form action="<?= base_url('/update-password') ?>" method="post" id="passwordForm">
                    <?= csrf_field() ?>

                    <div class="password-section">
                        <h6>
                            <i class="mdi mdi-shield-key"></i>
                            Ubah Password
                        </h6>

                        <div class="form-group-custom">
                            <label for="password_lama" class="form-label-custom">
                                <i class="mdi mdi-lock"></i>
                                Password Lama
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="password_lama" id="password_lama"
                                    class="form-control form-control-custom" required>
                                <i class="mdi mdi-eye password-toggle" onclick="togglePassword('password_lama')"></i>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="password_baru" class="form-label-custom">
                                <i class="mdi mdi-lock-plus"></i>
                                Password Baru
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="password_baru" id="password_baru"
                                    class="form-control form-control-custom" required
                                    onkeyup="checkPasswordStrength(this.value)">
                                <i class="mdi mdi-eye password-toggle" onclick="togglePassword('password_baru')"></i>
                            </div>
                            <div class="password-strength">
                                <div class="password-strength-bar" id="strengthBar"></div>
                            </div>
                            <div class="password-requirements">
                                <div class="requirement invalid" id="req-length">
                                    <i class="mdi mdi-close-circle"></i>
                                    Minimal 8 karakter
                                </div>
                                <div class="requirement invalid" id="req-upper">
                                    <i class="mdi mdi-close-circle"></i>
                                    Mengandung huruf besar
                                </div>
                                <div class="requirement invalid" id="req-lower">
                                    <i class="mdi mdi-close-circle"></i>
                                    Mengandung huruf kecil
                                </div>
                                <div class="requirement invalid" id="req-number">
                                    <i class="mdi mdi-close-circle"></i>
                                    Mengandung angka
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="konfirmasi_password" class="form-label-custom">
                                <i class="mdi mdi-lock-check"></i>
                                Konfirmasi Password Baru
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="konfirmasi_password" id="konfirmasi_password"
                                    class="form-control form-control-custom" required
                                    onkeyup="checkPasswordMatch()">
                                <i class="mdi mdi-eye password-toggle" onclick="togglePassword('konfirmasi_password')"></i>
                            </div>
                            <div id="password-match-message" class="mt-2" style="font-size: 12px;"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="button" class="btn btn-secondary-custom btn-custom" onclick="resetForm()">
                            <i class="mdi mdi-refresh me-2"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary-custom btn-custom">
                            <i class="mdi mdi-content-save me-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Activity Card -->
        <div class="settings-card">
            <div class="card-header-custom">
                <h5>
                    <i class="mdi mdi-history"></i>
                    Aktivitas Akun
                </h5>
            </div>
            <div class="card-body-custom">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="mdi mdi-login text-primary" style="font-size: 32px;"></i>
                            <h6 class="mt-2 mb-0">Login Terakhir</h6>
                            <small class="text-muted"><?= date('d M Y, H:i') ?></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="mdi mdi-shield-check text-success" style="font-size: 32px;"></i>
                            <h6 class="mt-2 mb-0">Status Keamanan</h6>
                            <small class="text-success">Aman</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="mdi mdi-account-check text-info" style="font-size: 32px;"></i>
                            <h6 class="mt-2 mb-0">Status Akun</h6>
                            <small class="text-info">Aktif</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling;

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('mdi-eye');
            icon.classList.add('mdi-eye-off');
        } else {
            field.type = 'password';
            icon.classList.remove('mdi-eye-off');
            icon.classList.add('mdi-eye');
        }
    }

    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('strengthBar');
        const requirements = {
            length: password.length >= 8,
            upper: /[A-Z]/.test(password),
            lower: /[a-z]/.test(password),
            number: /\d/.test(password)
        };

        // Update requirements visual feedback
        Object.keys(requirements).forEach(req => {
            const element = document.getElementById(`req-${req}`);
            const icon = element.querySelector('i');

            if (requirements[req]) {
                element.classList.remove('invalid');
                element.classList.add('valid');
                icon.classList.remove('mdi-close-circle');
                icon.classList.add('mdi-check-circle');
            } else {
                element.classList.remove('valid');
                element.classList.add('invalid');
                icon.classList.remove('mdi-check-circle');
                icon.classList.add('mdi-close-circle');
            }
        });

        // Calculate strength
        const validCount = Object.values(requirements).filter(Boolean).length;
        strengthBar.className = 'password-strength-bar';

        if (validCount === 0) {
            strengthBar.style.width = '0%';
        } else if (validCount === 1) {
            strengthBar.classList.add('strength-weak');
        } else if (validCount === 2) {
            strengthBar.classList.add('strength-fair');
        } else if (validCount === 3) {
            strengthBar.classList.add('strength-good');
        } else {
            strengthBar.classList.add('strength-strong');
        }

        checkFormValidity();
    }

    function checkPasswordMatch() {
        const newPassword = document.getElementById('password_baru').value;
        const confirmPassword = document.getElementById('konfirmasi_password').value;
        const messageDiv = document.getElementById('password-match-message');

        if (confirmPassword === '') {
            messageDiv.innerHTML = '';
            return;
        }

        if (newPassword === confirmPassword) {
            messageDiv.innerHTML = '<i class="mdi mdi-check-circle text-success me-1"></i><span class="text-success">Password cocok</span>';
        } else {
            messageDiv.innerHTML = '<i class="mdi mdi-close-circle text-danger me-1"></i><span class="text-danger">Password tidak cocok</span>';
        }

        checkFormValidity();
    }

    function checkFormValidity() {
        const oldPassword = document.getElementById('password_lama').value;
        const newPassword = document.getElementById('password_baru').value;
        const confirmPassword = document.getElementById('konfirmasi_password').value;
        const submitBtn = document.getElementById('submitBtn');

        const requirements = {
            length: newPassword.length >= 8,
            upper: /[A-Z]/.test(newPassword),
            lower: /[a-z]/.test(newPassword),
            number: /\d/.test(newPassword)
        };

        const allRequirementsMet = Object.values(requirements).every(Boolean);
        const passwordsMatch = newPassword === confirmPassword;
        const allFieldsFilled = oldPassword && newPassword && confirmPassword;

        if (allFieldsFilled && allRequirementsMet && passwordsMatch) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    function resetForm() {
        document.getElementById('passwordForm').reset();
        document.getElementById('strengthBar').className = 'password-strength-bar';
        document.getElementById('password-match-message').innerHTML = '';

        // Reset requirements
        ['length', 'upper', 'lower', 'number'].forEach(req => {
            const element = document.getElementById(`req-${req}`);
            const icon = element.querySelector('i');
            element.classList.remove('valid');
            element.classList.add('invalid');
            icon.classList.remove('mdi-check-circle');
            icon.classList.add('mdi-close-circle');
        });

        document.getElementById('submitBtn').disabled = true;
    }

    // Add event listeners
    document.addEventListener('DOMContentLoaded', function() {
        ['password_lama', 'password_baru', 'konfirmasi_password'].forEach(id => {
            document.getElementById(id).addEventListener('input', checkFormValidity);
        });
    });
</script>

<?= $this->endSection() ?>