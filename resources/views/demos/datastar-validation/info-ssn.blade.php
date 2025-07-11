<script>
  window.basecoat = window.basecoat || {};
  window.basecoat.registerDialog = function (Alpine) {
    if (Alpine.components && Alpine.components.dialog) return;

    Alpine.data("dialog", (initialOpen = false, initialCloseOnOverlayClick = true) => ({
      id: null,
      open: false,
      closeOnOverlayClick: true,

      init() {
        this.id = this.$el.id;
        if (!this.id) {
          console.warn("Dialog component initialized without an `id`. This may cause issues with event targeting and accessibility.");
        }
        this.open = initialOpen;
        this.closeOnOverlayClick = initialCloseOnOverlayClick;
      },
      show() {
        if (!this.open) {
          this.open = true;
          this.$nextTick(() => {
            this.$el.dispatchEvent(new CustomEvent("dialog:opened", { bubbles: true, detail: { id: this.id } }));
            setTimeout(() => {
              const focusTarget = this.$refs.focusOnOpen || this.$el.querySelector('[role="dialog"]');
              if (focusTarget) focusTarget.focus();
            }, 50);
          });
        }
      },
      hide() {
        if (this.open) {
          this.open = false;
          this.$nextTick(() => {
            this.$el.dispatchEvent(new CustomEvent("dialog:closed", { bubbles: true, detail: { id: this.id } }));
          });
        }
      },

      $main: {
        "@dialog:open.window"(e) {
          if (e.detail && e.detail.id === this.id) this.show();
        },
        "@dialog:close.window"(e) {
          if (e.detail && e.detail.id === this.id) this.hide();
        },
        "@keydown.escape.window"() {
          this.open && this.hide();
        },
      },
      $trigger: {
        "@click"() {
          this.show();
        },
        ":aria-expanded"() {
          return this.open;
        },
      },
      $content: {
        ":inert"() {
          return !this.open;
        },
        "@click.self"() {
          if (this.closeOnOverlayClick) this.hide();
        },
        "x-cloak": "",
      },
    }));
  };

  document.addEventListener("alpine:init", () => {
    window.basecoat.registerDialog(Alpine);
  });
</script>
<div id="alert-dialog" x-data="dialog(false, false)" x-bind="$main" class="dialog">
  <button type="button" aria-expanded="false" aria-controls="alert-dialog-dialog" x-bind="$trigger" class="cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 inline text-gray-400 hover:text-gray-600 transition">
      <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 0 1-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 0 1-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 0 1-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584ZM12 18a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
    </svg>
  </button>

  <div role="dialog" id="alert-dialog-dialog" tabindex="-1" aria-modal="true" aria-labelledby="alert-dialog-title" inert x-bind="$content">
    <article>
      <header>
        <h2 id="alert-dialog-title">Why do we require your Social Security Number?</h2>
        <p class="mt-4">The reason is simple: authenticity.</p>
        <p>Without verifying your legal name with the United States government registry of valid SSNs and names, we cannot guarantee that you or the people you are meeting <b class="text-gray-900">truly have a Z in their names</b>.</p>
        <p>We could not in good conscious let you go on a date under false pretenses. This is our commitment to you.</p>
      </header>

      <footer>
        <button type="button" class="btn-outline" @click="open = false">Great point!</button>
        <!-- <button class="btn-primary" @click="open = false">Got it</button> -->
      </footer>
    </article>
  </div>
</div>
