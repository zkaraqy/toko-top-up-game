document.addEventListener("DOMContentLoaded", function (domEv) {
  function capitalizeWords(str) {
      return str.split(' ').map(word => {
        if (word.length === 0) {
          return "";
        }
        return word.charAt(0).toUpperCase() + word.slice(1);
      }).join(' ');
    }

  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );

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
    games: "game",
    "payment-methods": "metode pembayaran",
    penjualan: "penjualan",
  };
  const mapContextAPI = {
    users: "apiusers",
    games: "apigames",
    "payment-methods": "apipaymentmethods",
    penjualan: "apipenjualan",
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
    modalHapusElement.addEventListener("show.bs.modal", async (event) => {
      const button = event.relatedTarget;
      const id = button.getAttribute("data-id");
      const context = button.getAttribute("data-context");
      const btnPositive = document.getElementById("modal-btn-positive");
      const spinnerTombolModalHapus = document.getElementById(
        "spinner-tombol-modal-hapus"
      );

      let entityType = "";
      if (context === "users") entityType = "user";
      else if (context === "games") entityType = "game";
      else if (context === "payment-methods") entityType = "payment_method";

      if (["users", "games", "payment-methods"].includes(context)) {
        try {
          modalHapusElement.querySelector(
            ".modal-title"
          ).innerText = `Memeriksa ketergantungan ${getContext(context)}...`;
          modalHapusElement.querySelector(
            ".modal-body p"
          ).innerText = `Mohon tunggu, sedang memeriksa apakah ${getContext(
            context
          )} ini dapat dihapus...`;
          btnPositive.style.display = "none";

          const formData = new FormData();
          formData.append("entity_type", entityType);
          formData.append("entity_id", id);

          const dependencyResponse = await fetch("/api/check-dependencies", {
            method: "POST",
            body: formData,
          });

          const dependencyResult = await dependencyResponse.json();

          if (dependencyResult.is_used) {
            modalHapusElement.querySelector(
              ".modal-title"
            ).innerText = `${capitalizeWords(getContext(context))} Tidak Dapat Dihapus`;
            modalHapusElement.querySelector(".modal-body p").innerText =
              dependencyResult.message;
            btnPositive.style.display = "none";
            document.getElementById("modal-btn-negative").innerText = "Tutup";
            return; 
          } else {
            modalHapusElement.querySelector(
              ".modal-title"
            ).innerText = `Hapus ${getContext(context)}`;
            modalHapusElement.querySelector(
              ".modal-body p"
            ).innerText = `Apakah Anda yakin ingin menghapus ${getContext(
              context
            )} ini?`;
            btnPositive.style.display = "inline-block";
            document.getElementById("modal-btn-negative").innerText = "Batal";
          }
        } catch (e) {
          console.error("Error checking dependencies:", e);
          modalHapusElement.querySelector(".modal-title").innerText = `Error`;
          modalHapusElement.querySelector(
            ".modal-body p"
          ).innerText = `Gagal memeriksa ketergantungan ${getContext(
            context
          )}. Coba lagi nanti.`;
          btnPositive.style.display = "none";
          document.getElementById("modal-btn-negative").innerText = "Tutup";
          return;
        }
      }

      const newBtnPositive = btnPositive.cloneNode(true);
      btnPositive.parentNode.replaceChild(newBtnPositive, btnPositive);

      newBtnPositive.addEventListener("click", async function () {
        try {
          newBtnPositive.setAttribute("disabled", true);
          spinnerTombolModalHapus.classList.replace("d-none", "d-inline-block");
          const response = await fetch(`/api/${mapContextAPI[context]}/` + id, {
            method: "DELETE",
          });
          const result = await response.json();

          if (response.ok) {
            modalInfoElement.querySelector(
              "h1"
            ).innerText = `Berhasil menghapus ${getContext(context)}!`;
            modalInfoElement.querySelector(
              "div.modal-body"
            ).innerText = `Telah berhasil menghapus ${getContext(context)}`;

            if (document.URL.includes("/detail/")) {
              modalInfo.show();
              return setTimeout(() => {
                return history.back();
              }, 2000);
            }
            document.getElementById(id).remove();
          } else {
            modalInfoElement.querySelector(
              "h1"
            ).innerText = `Gagal menghapus ${getContext(context)}!`;
            modalInfoElement.querySelector("div.modal-body").innerText =
              result.message || `Gagal menghapus ${getContext(context)}.`;
          }

          newBtnPositive.removeAttribute("disabled");
          spinnerTombolModalHapus.classList.replace("d-inline-block", "d-none");
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
        } else {
          imagePreview.classList.add("d-none");
          if (noImagePreview) noImagePreview.style.display = "block";
        }
      });
    }
  }

  function getContext(context) {
    return mapContext[context] ?? "data";
  }

  function handleResetPassword() {
    let resetPasswordController = null;

    modalResetPasswordElement?.addEventListener(
      "show.bs.modal",
      async (event) => {
        const button = event.relatedTarget;
        const id = button.getAttribute("data-id");
        const context = button.getAttribute("data-context");

        const tombolAksiResetPassword = document.getElementById(
          "tombol-yakin-modal-reset-password"
        );
        const spinnerTombolModalResetPassword = document.getElementById(
          "spinner-tombol-modal-reset-password"
        );

        const newTombolAksiResetPassword =
          tombolAksiResetPassword.cloneNode(true);
        tombolAksiResetPassword.parentNode.replaceChild(
          newTombolAksiResetPassword,
          tombolAksiResetPassword
        );

        if (resetPasswordController) {
          resetPasswordController.abort();
        }

        resetPasswordController = new AbortController();

        newTombolAksiResetPassword.addEventListener(
          "click",
          async function (event) {
            try {
              newTombolAksiResetPassword.setAttribute("disabled", true);
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
              console.log({ result });

              if (result.success) {
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
                modalInfoElement.querySelector(".modal-header").className =
                  "modal-header";
                modalInfoElement.querySelector(
                  "h1"
                ).innerHTML = `<i class="ti ti-alert-circle me-2"></i>Gagal reset password!`;
                modalInfoElement.querySelector("div.modal-body").innerText =
                  result.message || "Terjadi kesalahan saat reset password";
              }
            } catch (error) {
              console.error("Error:", error);
              modalInfoElement.querySelector("h1").innerText =
                "Terjadi kendala pada aplikasi";
              modalInfoElement.querySelector("div.modal-body").innerText =
                "Terjadi kendala pada aplikasi, mohon hubungi admin";
            } finally {
              newTombolAksiResetPassword.removeAttribute("disabled");
              spinnerTombolModalResetPassword.classList.replace(
                "d-inline-block",
                "d-none"
              );
              modalInfo.show();
              modalResetPassword.hide();
              resetPasswordController = null;
            }
          },
          { signal: resetPasswordController.signal }
        );
      }
    );
  }

  handleResetPassword();
});
