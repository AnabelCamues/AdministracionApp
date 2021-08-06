<template>
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <app-breadcrumb
          :page-title="$t('Restaurantes')"
          :directory="$t('datatables')"
          :icon="'grid'"
        />
      </div>
      <div class="col-sm-12 col-md-6 breadcrumb-side-button">
        <div class="float-md-right mb-3 mb-sm-3 mb-md-0">
          <button
            type="button"
            class="btn btn-primary btn-with-shadow"
            data-toggle="modal"
            @click="openAddEditModal"
          >
            {{ $t("Añadir") }}
          </button>
        </div>
      </div>
    </div>
    <app-table :id="tableId" :options="options" @action="getListAction" />
  </div>
</template>

<script>
// import CoreLibrary from "../../../../../../core/helpers/CoreLibrary.js";

import * as actions from "../../../../Config/ApiUrl";
import CoreLibrary from "../../../../../core/helpers/CoreLibrary";
import { TableHelpers } from "./TableHelpers";

export default {
  extends: CoreLibrary,
  name: "Index",
  mixins: [TableHelpers],
  data() {
    return {
      deleteLoader: false,
      isAddEditModalActive: false,
      deleteConfirmationModalActive: false,
      selectedUrl: "",
      tableId: "demo-crud-table",
      rowData: {},
      options: {
        url: `${actions.ORGANIZATION}/index`,
        name: this.$t("demo_crud"),
        datatableWrapper: false,
        showHeader: true,
        columns: [],
        actions: [
          {
            title: this.$t("edit"),
            icon: "edit",
            type: "none",
            component: "app-add-modal",
            modalId: "demo-add-edit-Modal",
          },
          {
            title: this.$t("delete"),
            icon: "trash",
            type: "none",
            component: "app-confirmation-modal",
            modalId: "demo-delete",
          },
        ],
        showFilter: false,
        showSearch: false,
        paginationType: "pagination",
        responsive: true,
        rowLimit: 10,
        showAction: true,
        orderBy: "desc",
        actionType: "default",
      },
    };
  },
  created() {
    this.options.columns = [...this.tableColumns, this.actionObj];
  },
  methods: {
    /**
     * for open add edit modal
     */
    openAddEditModal() {
      this.isAddEditModalActive = true;
    },

    /**
     * for close add edit modal
     */
    closeAddEditModal() {
      $("#demo-add-edit-Modal").modal("hide");
      this.isAddEditModalActive = false;
      this.reSetData();
    },

    /**
     * $emit Form datatable action
     */
    getListAction(rowData, actionObj, active) {
      this.rowData = rowData;

      if (actionObj.title == "Delete") {
        this.openDeleteModal();
      } else if (actionObj.title == this.$t("edit")) {
        this.selectedUrl = `${actions.ORGANIZATION}/${rowData.id}`;
        this.openAddEditModal();
      }
    },

    /**
     * for open confirmation modal
     */
    openDeleteModal() {
      this.deleteConfirmationModalActive = true;
    },

    /**
     * confirmed $emit Form confirmation modal
     */
    confirmed() {
      let url = `${actions.ORGANIZATION}/${this.rowData.id}`;
      this.deleteLoader = true;
      this.axiosDelete(url)
        .then((response) => {
          this.deleteLoader = false;
          $("#demo-delete").modal("hide");
          this.cancelled();
          this.$toastr.s(response.data.message);
        })
        .catch(({ error }) => {
          //trigger after error
        })
        .finally(() => {
          this.$hub.$emit("reload-" + this.tableId);
        });
    },

    /**
     * cancelled $emit Form confirmation modal
     */
    cancelled() {
      this.deleteConfirmationModalActive = false;
      this.reSetData();
    },

    reSetData() {
      this.rowData = {};
      this.selectedUrl = "";
    },
  },
};
</script>
