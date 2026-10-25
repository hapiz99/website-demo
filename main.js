document.querySelectorAll(".navbar-collapse .nav-link").forEach((link) => {
  link.addEventListener("click", () => {
    const navbar = document.querySelector(".navbar-collapse");
    if (navbar.classList.contains("show")) {
      window.bootstrap.Collapse.getOrCreateInstance(navbar).hide();
    }
  });
});

const contactForm = document.querySelector("#contact-form");

contactForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  const submitButton = contactForm.querySelector('button[type="submit"]');
  const status = document.querySelector("#contact-form-status");
  submitButton.disabled = true;
  status.textContent = "Sending your message...";

  try {
    const response = await fetch(contactForm.action, {
      method: "POST",
      body: new FormData(contactForm),
      headers: { Accept: "application/json" },
    });
    const result = await response.json();

    if (!response.ok || !result.success) {
      throw new Error(result.message || "Your message could not be sent. Please try again.");
    }

    status.textContent = result.message;
    contactForm.reset();
  } catch (error) {
    status.textContent =
      error instanceof TypeError
        ? "Could not connect to the mail server. Please try again later."
        : error.message;
  } finally {
    submitButton.disabled = false;
  }
});
