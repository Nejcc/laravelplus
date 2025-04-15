// registerComponents.js

import NavbarComponent from "@/components/NavbarComponent.vue";
import PermissionsComponent from "@/components/admin/PermissionsComponent.vue";
import PaginationComponent from "@/components/common/PaginationComponent.vue";

export default function registerComponents(app) {
    app.component('vue-navbar', NavbarComponent);
    app.component('permissions-component', PermissionsComponent);
    app.component('pagination', PaginationComponent);
}