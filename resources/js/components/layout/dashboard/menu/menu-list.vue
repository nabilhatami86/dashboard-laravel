<template>
    <div>
        <div class="my-3 mx-4 uppercase text-gray-300 text-xs">
            {{ $t('Umum') }}
        </div>
        <menu-item
            :label="$t('Dasbor')"
            :mobile="mobile"
            icon="font-awesome.tachometer-alt-regular"
            to="/dashboard/home"
        ></menu-item>
        <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.TicketController']"
            :label="$t('Tiket')"
            :mobile="mobile"
            icon="font-awesome.inbox-regular"
            to="/dashboard/tickets"
        ></menu-item>
        <!-- <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.CannedReplyController']"
            :label="$t('Balasan otomatis')"
            :mobile="mobile"
            icon="font-awesome.comments-alt-regular"
            to="/dashboard/canned-replies"
        ></menu-item> -->
        <div
            v-if="$store.state.permissions && (
                $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.UserController'] ||
                $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.UserRoleController'] ||
                $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.SettingController'] ||
                $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.LanguageController']
            )"
            class="my-3 mx-4 uppercase text-gray-300 text-xs"
        >
            {{ $t('Administrasi') }}
        </div>
        <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.DepartmentController']"
            :label="$t('Departemen')"
            :mobile="mobile"
            icon="font-awesome.users-class-regular"
            to="/dashboard/admin/departments"
        ></menu-item>
        <!-- <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.LabelController']"
            :label="$t('Label')"
            :mobile="mobile"
            icon="font-awesome.tags-regular"
            to="/dashboard/admin/labels"
        ></menu-item> -->
        <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.StatusController']"
            :label="$t('Status')"
            :mobile="mobile"
            icon="font-awesome.tasks-regular"
            to="/dashboard/admin/statuses"
        ></menu-item>
        <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.PriorityController']"
            :label="$t('Prioritas')"
            :mobile="mobile"
            icon="font-awesome.pennant-regular"
            to="/dashboard/admin/priorities"
        ></menu-item>
        <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.UserController']"
            :label="$t('Pengguna')"
            :mobile="mobile"
            icon="font-awesome.users-regular"
            to="/dashboard/admin/users"
        ></menu-item>
        <!-- <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.UserRoleController']"
            :label="$t('Peran Pengguna')"
            :mobile="mobile"
            icon="font-awesome.id-card-regular"
            to="/dashboard/admin/user-roles"
        ></menu-item> -->
        <!-- <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.SettingController']"
            :label="$t('Pengaturan')"
            :mobile="mobile"
            icon="font-awesome.cog-regular"
            to="/dashboard/admin/settings"
        ></menu-item> -->
        <!-- <menu-item
            v-if="$store.state.permissions && $store.state.permissions['App.Http.Controllers.Api.Dashboard.Admin.LanguageController']"
            :label="$t('Terjemahan')"
            :mobile="mobile"
            icon="font-awesome.language-regular"
            to="/dashboard/admin/languages"
        ></menu-item> -->
    </div>
</template>

<script>
import MenuItem from "@/components/layout/dashboard/menu/menu-item";

export default {
    name: "menu-list",
    components: {MenuItem},
    props: {
        mobile: {
            type: Boolean,
            required: false
        }
    }
}
</script>
