<template>
    <div v-loading="loading">
        <template v-if="!loading">
            <div class="table-responsive">
                <table class="table data-table">
                    <template v-if="records.length > 0">
                        <thead>
                        <slot name="heading"></slot>
                        </thead>
                        <tbody>
                        <slot v-for="(row, index) in records" :row="row" :index="customIndex(index)"></slot>
                        </tbody>
                    </template>
                    <template v-else>
                        <div class="alert alert-info">No se encontraron resultados.</div>
                    </template>
                </table>
            </div>
            <div class="data-table_footer" v-if="records.length > 0">
                <div>
                    <el-pagination
                            @size-change="clickSizeChange"
                            @current-change="clickCurrentChange"
                            :current-page="pagination.currentPage"
                            :page-sizes="pagination.pageSizes"
                            :page-size="pagination.pageSize"
                            layout="prev, pager, next, jumper, sizes, total"
                            :total="pagination.total"
                            :background="true">
                    </el-pagination>
                </div>
                <div class="data-table_footer-sort">
                    <span>Ordenar por </span>
                    <el-select v-model="query.sortColumn" @change="getRecords" class="select-column">
                        <el-option v-for="option in sortableColumns"
                                   :key="option.value"
                                   :label="option.label"
                                   :value="option.value"></el-option>
                    </el-select>
                    <el-select v-model="query.sortDirection" @change="getRecords" class="select-sort">
                        <el-option key="asc" value="asc" label="ASC"></el-option>
                        <el-option key="desc" value="desc" label="DESC"></el-option>
                    </el-select>
                </div>
            </div
            
            <modal-delete-form v-if="buttonDelete"
                               :showDialog.sync="showDialogModalDeleteForm"
                               :resource="resourceDelete"></modal-delete-form>
        </template>
        <template v-else>
            <div style="height: 100px">

            </div>
        </template>
    </div>
</template>

<script>

    import moment from 'moment'
    import queryString from 'query-string'
    import ModalDeleteForm from '../../modals/src/Delete'

    export default {
        props: {
            resource: String,
            resourceAdditional : {
                type: String,
                default: null
            },
            buttonEdit: {
                type: Boolean,
                default: true
            },
            buttonDelete: {
                type: Boolean,
                default: true
            },
        },
        components: {ModalDeleteForm},
        data () {
            return {
                loading: true,
                records: [],
                pagination: {
                    currentPage: 1,
                    pageSizes: [],
                    pageSize: null,
                    total: 0,
                },
                showDialogModalDeleteForm: false,
                resourceDelete: null,
                sortableColumns: [],
                filterColumns: [],
                query: {
                    filterColumn: null,
                    valueColumn: null,
                    sortColumn: null,
                    sortDirection: null
                }
            }
        },
//        computed: {
//            totalRecords() {
//                return this.records.length
//            }
//        },
        async created() {
            this.$eventHub.$on('reloadData', () => {
                this.getRecords()
            })
            this.$eventHub.$on('clickDelete', (row) => {
                this.clickDelete(row)
            })
            this.$eventHub.$on('clickSort', (column) => {
                this.clickSort(column)
            })
            await this.initTable()
            await this.getRecords()
//            this.loading = false
        },
        mounted () {
        },
        methods: {
            customIndex(index) {
                return (this.pagination.pageSize * (this.pagination.currentPage - 1)) + index + 1
            },
            customResource() {
                return _.isNull(this.resourceAdditional)?this.resource:`${this.resource}/${this.resourceAdditional}`
            },
            async initTable() {
                await this.$http.get(`/${this.customResource()}/init_data_table`).then((response) => {
                    this.pagination.pageSizes = response.data.page_sizes;
                    this.query.sortDirection = response.data.default_sort_direction;
                    this.query.sortColumn = response.data.default_sort_column;
                    this.sortableColumns = response.data.sortable_columns;
                    this.pagination.pageSize = response.data.page_size;
                    this.filterColumns = response.data.filter_columns;
                })
            },
            clickDirectionSort() {
                if(this.query.sortDirection === 'desc') {
                    this.query.sortDirection = 'asc'
                } else {
                    this.query.sortDirection = 'desc'
                }
                this.getRecords()
            },
            clickSizeChange(size) {
                this.pagination.currentPage = 1
                this.pagination.pageSize = size
                this.getRecords()
            },
            clickCurrentChange(page) {
                this.pagination.currentPage = page
                this.getRecords()
            },
            getRecords() {
                this.records = []
                let Query = queryString.stringify({
                    page: this.pagination.currentPage,
                    limit: this.pagination.pageSize,
                    sort_column: this.query.sortColumn,
                    sort_direction: this.query.sortDirection,
//                    ...this.search
                })

                this.loading = true
                this.$http.get(`/${this.customResource()}/records?${Query}`)
                    .then((response) => {
                        this.pagination.total = response.data.meta.total
                        this.records = response.data.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
                    .then(()=> {
                        this.loading = false
                    });
            },
            clickSort(column) {
                this.query.sortColumn = column
                this.clickDirectionSort()
            },
            clickDelete(row) {
                this.showDialogModalDeleteForm = true
                this.resourceDelete = `${this.resource}/${row.id}`
            }
        }
    }
</script>
