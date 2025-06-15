document.addEventListener("DOMContentLoaded", function (domEv) {
  const modalHapusElement = document.getElementById("modalHapus");
  const modalInfoElement = document.getElementById("modalInfo");
  const modalResetPasswordElement =
    document.getElementById("modalResetPassword");
  let modalInfo;
  let modalHapus;
  let modalResetPassword;
  try {
    modalInfo = new bootstrap.Modal(modalInfoElement);
    modalHapus = new bootstrap.Modal(modalHapusElement);
    modalResetPassword = new bootstrap.Modal(modalResetPasswordElement);
    const dropdownElementList = document.querySelectorAll(".dropdown-toggle");
    const dropdownList = [...dropdownElementList].map(
      (dropdownToggleEl) => new bootstrap.Dropdown(dropdownToggleEl)
    );
  } catch (error) {
    console.log(error.message);
  }

  const togglePassword = document.getElementById("toggle-password");
  const fieldPassword = document.getElementById("input-password");

  const openEyeIconClass = "ti ti-eye";
  const offEyeIconClass = "ti ti-eye-off";

  const mapContext = {
    users: "user",
  };
  const mapContextAPI = {
    users: "apiusers",
  };

  if (togglePassword && fieldPassword) {
    togglePassword.addEventListener("click", function (el) {
      if (togglePassword.children[0].classList == openEyeIconClass) {
        fieldPassword.setAttribute("type", "text");
        togglePassword.innerHTML = `<i class="${offEyeIconClass}"></i>`;
      } else {
        fieldPassword.setAttribute("type", "password");
        togglePassword.innerHTML = `<i class="${openEyeIconClass}"></i>`;
      }
    });
  }

  if (modalHapusElement && modalInfoElement) {
    modalInfoElement.addEventListener("hidden.bs.modal", function (event) {
      // Refresh halaman
      // window.location.reload();
    });

    modalHapusElement.addEventListener("show.bs.modal", async (event) => {
      const button = event.relatedTarget;
      const id = button.getAttribute("data-id");
      const context = button.getAttribute("data-context");``
      const btnPositive = document.getElementById("modal-btn-positive");
      const spinnerTombolModalHapus = document.getElementById(
        "spinner-tombol-modal-hapus"
      );
      btnPositive.addEventListener("click", async function () {
        try {
          btnPositive.setAttribute("disabled", true);
          spinnerTombolModalHapus.classList.replace("d-none", "d-inline-block");
          const response = await fetch(`/api/${mapContextAPI[context]}/` + id, {
            method: "DELETE",
          });
          const result = await response.json();
          if (result) {
            modalInfoElement.querySelector(
              "h1"
            ).innerText = `Berhasil menghapus ${getContext(context)}!`;
            modalInfoElement.querySelector(
              "div.modal-body"
            ).innerText = `Telah berhasil menghapus ${getContext(context)}`;
          } else {
            modalInfoElement.querySelector(
              "h1"
            ).innerText = `Gagal menghapus ${getContext(context)}!`;
          }
          btnPositive.removeAttribute("disabled");
          spinnerTombolModalHapus.classList.replace("d-inline-block", "d-none");
          if (document.URL.includes("/admin/users/detail/")) {
            modalInfo.show();
            return setTimeout(() => {
              return history.back();
            }, 2000);
          }
          document.getElementById(id).remove();
          modalInfo.show();
        } catch (e) {
          console.log(e);
          modalInfoElement.querySelector("h1").innerText =
            "Terjadi kendala pada aplikasi";
          modalInfoElement.querySelector("div.modal-body").innerText =
            "Terjadi kendala pada aplikasi, mohon hubungi admin";
          modalInfo.show();
        } finally {
          modalHapus.hide();
        }
      });
    });

    const fotoInput = document.getElementById("foto");
    const imagePreview = document.getElementById("imagePreview");
    const noImagePreview = document.getElementById("noImagePreview");

    if (fotoInput) {
      fotoInput.addEventListener("change", function () {
        if (fotoInput.files && fotoInput.files[0]) {
          const reader = new FileReader();

          reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove("d-none");
            if (noImagePreview) {
              noImagePreview.classList.add("d-none");
            }
          };

          reader.readAsDataURL(fotoInput.files[0]);
        }
      });
    }
  }

  function getContext(context) {
    return mapContext[context] ?? "data";
  }

  let resetPasswordController;

  modalResetPasswordElement.addEventListener("show.bs.modal", async (event) => {
    const button = event.relatedTarget;
    const id = button.getAttribute("data-id");
    const context = button.getAttribute("data-context");

    const tombolAksiResetPassword = document.getElementById(
      "tombol-yakin-modal-reset-password"
    );
    const spinnerTombolModalResetPassword = document.getElementById(
      "spinner-tombol-modal-reset-password"
    );

    if (resetPasswordController) {
      resetPasswordController.abort();
    }

    resetPasswordController = new AbortController();

    tombolAksiResetPassword.addEventListener(
      "click",
      async function (event) {
        try {
          tombolAksiResetPassword.setAttribute("disabled", true);
          spinnerTombolModalResetPassword.classList.replace(
            "d-none",
            "d-inline-block"
          );

          const formData = new FormData();
          formData.append("id", id);

          const response = await fetch("/api/users/reset-password", {
            method: "POST",
            body: formData,
          });

          const result = await response.json();
          if (result.success) {
            // Change modal header color for success
            modalInfoElement.querySelector(".modal-header").className =
              "modal-header";
            modalInfoElement.querySelector(
              "h1"
            ).innerHTML = `<i class="ti ti-check-circle me-2"></i>Password berhasil direset!`;

            const passwordHtml = `
            <div class="password-display">
              <p class="mb-2">Password baru untuk user "${result.username}":</p>
              <div class="fw-bold" >${result.new_password}</div>
            </div>`;

            modalInfoElement.querySelector("div.modal-body").innerHTML =
              passwordHtml;
          } else {
            // Reset modal header color for error
            modalInfoElement.querySelector(".modal-header").className =
              "modal-header";
            modalInfoElement.querySelector(
              "h1"
            ).innerHTML = `<i class="ti ti-alert-circle me-2"></i>Gagal reset password!`;
            modalInfoElement.querySelector("div.modal-body").innerText =
              result.message || "Terjadi kesalahan saat reset password";
          }

          tombolAksiResetPassword.removeAttribute("disabled");
          spinnerTombolModalResetPassword.classList.replace(
            "d-inline-block",
            "d-none"
          );
          modalInfo.show();
        } catch (error) {
          console.error("Error:", error);
          modalInfoElement.querySelector("h1").innerText =
            "Terjadi kendala pada aplikasi";
          modalInfoElement.querySelector("div.modal-body").innerText =
            "Terjadi kendala pada aplikasi, mohon hubungi admin";
          modalInfo.show();

          tombolAksiResetPassword.removeAttribute("disabled");
          spinnerTombolModalResetPassword.classList.replace(
            "d-inline-block",
            "d-none"
          );
        } finally {
          modalResetPassword.hide();
        }
      },
      { signal: resetPasswordController.signal }
    );
  });
});
