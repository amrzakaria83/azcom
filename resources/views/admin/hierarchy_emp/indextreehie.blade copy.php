@extends('admin.layout.master')

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('style')

@endsection

@section('breadcrumb')
<div class="d-flex align-items-center" id="kt_header_nav">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <a  href="{{url('/admin')}}">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                لوحة التحكم
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="#" class="text-muted text-hover-primary">الموظفين</a>
            </li>
            {{-- <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li> --}}

        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')
    <!--begin::Container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="card no-border">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    {{-- <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-db-table-filter="search" id="search" name="search" class="form-control form-control-solid bg-light-dark text-dark w-250px ps-14" placeholder="Search user" />
                        </div>
                    </div> --}}
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        {{-- <div class="d-flex justify-content-end dbuttons"> --}}
                            {{-- <a href="{{route('admin.employees.create')}}" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3">
                                <i class="bi bi-plus-square fs-1x"></i>
                            </a> --}}
                            {{-- <button type="button" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3" data-bs-toggle="modal" data-bs-target="#kt_modal_filter">
                                <i class="bi bi-funnel-fill fs-1x"></i>
                            </button> --}}
                            {{-- <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete" data-token="{{ csrf_token() }}">
                                <i class="bi bi-trash3-fill fs-1x"></i>
                            </button> --}}
                        {{-- </div> --}}
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <div class="card">
                        <h3 class="card-title">Employee Hierarchy</h3>
                      <!--begin::Table-->
                    <div id="kt_docs_jstree_contextual"></div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->

                <div class="modal fade" id="kt_modal_filter" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_filter_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Filter</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->

                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <div class="fv-row mb-7">

                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                            <select name="is_active" id="is_active" data-control="select2" data-placeholder="اختـر ..." data-hide-search="true" class="form-select form-select-solid fw-bold">
                                                <option></option>
                                                <option value="1">مفعل</option>
                                                <option value="0">غير مفعل</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="text-center pt-15">
                                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                                        <button type="submit" class="btn btn-primary" id="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
            </div>
    </div>
    <!--end::Container-->
@endsection

@section('script')
<script src="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/jstree/jstree.bundle.js')}}"></script>


<script>
$(document).ready(function() {
    var data = <?php echo json_encode($data); ?>;
    var dataemp = <?php echo json_encode($dataemp); ?>;
    console.log('Original dataemp:', dataemp);
    console.log('Original data:', data);
    
    // Debug: Check the actual above_hierarchy values
    data.forEach(function(node) {
        console.log('Node ID:', node.id, 'Above Hierarchy:', node.above_hierarchy, 'Emp Name:', node.getemp ? node.getemp.name_en : 'Unknown');
    });

    // Build proper hierarchy - use above_hierarchy to find parent
    function buildTree(nodes) {
        // Create a map for easy lookup
        var nodeMap = {};
        nodes.forEach(function(node) {
            nodeMap[node.id] = {
                ...node,
                children: []
            };
        });
        
        // Build the tree structure
        var rootNodes = [];
        
        nodes.forEach(function(node) {
            var aboveId = node.above_hierarchy;
            
            // If above_hierarchy exists and points to a valid node (and not itself)
            if (aboveId && aboveId != node.id && nodeMap[aboveId]) {
                // This is a child node, add to parent's children
                nodeMap[aboveId].children.push(nodeMap[node.id]);
            } else if (!aboveId || aboveId == 0 || aboveId == '') {
                // This is a root node (no above_hierarchy)
                rootNodes.push(nodeMap[node.id]);
            } else if (aboveId == node.id) {
                // Self-reference - treat as root node with warning
                console.warn('Self-referencing node:', node.id);
                rootNodes.push(nodeMap[node.id]);
            } else {
                // Invalid above_hierarchy - treat as root node
                console.warn('Invalid above_hierarchy for node:', node.id, 'above:', aboveId);
                rootNodes.push(nodeMap[node.id]);
            }
        });
        
        return rootNodes;
    }

    // Convert to jstree format
    function convertToJsTreeFormat(nodes) {
        return nodes.map(function(node) {
            var nodeText = '<span class="text-dark">' + (node.getemp ? node.getemp.name_en : 'Unknown') + '</span>';
            nodeText += ' <small class="text-muted">(ID: ' + node.id + ')</small>';
            
            if (node.above_hierarchy && node.above_hierarchy != node.id) {
                nodeText += ' <small class="text-info">↑ Parent: ' + node.above_hierarchy + '</small>';
            } else if (node.above_hierarchy == node.id) {
                nodeText += ' <small class="text-warning">↺ Self-reference</small>';
            } else {
                nodeText += ' <small class="text-success">🌱 Root</small>';
            }
            
            return {
                "id": node.id.toString(),
                "text": nodeText,
                "icon": "ki-solid ki-user text-primary",
                "data": node,
                "children": convertToJsTreeFormat(node.children)
            };
        });
    }

    var treeStructure = buildTree(data);
    var treeData = convertToJsTreeFormat(treeStructure);
    
    console.log('Tree data:', treeData);
    
    $("#kt_docs_jstree_contextual").jstree({
        "core": {
            "themes": { "responsive": false },
            "check_callback": true,
            'data': treeData
        },
        "plugins": ["types"]
    });
});
</script>
<!-- <script>
$(document).ready(function() {
  // Fetch the data from your model
    var data = <?php echo json_encode($data); ?>;
    console.log(data);
    var data =   data.sort((a, b) => a.above_hierarchy - b.above_hierarchy);
    function buildTree(nodes, above_hierarchy) {
        var result = [];
        for (var i = 0; i < nodes.length; i++) {
        if (nodes[i].parent_id === above_hierarchy) {
            var node = {
            "id": nodes[i].above_hierarchy, // Assuming 'id' is the unique identifier
            "text": '<span class="text-dark">' + nodes[i].getemp.name_en + '</span>' ,
                    // '-<span class="text-info">(' + nodes[i].name_en + ')</span>' +
                    // (nodes[i].value == 0 ? '' : `<span class="${nodes[i].value < 0 ? 'text-danger' : 'text-info'}">القيمة(${nodes[i].value})</span>`),
                    // (nodes[i].parent_value == 0 ? '' : `<span class="${nodes[i].parent_value < 0 ? 'text-danger' : 'text-info'}">اجمالى القيمة(${nodes[i].parent_value})</span>`)+
                    // (nodes[i].targete == 0 ? '' : `<span class="${nodes[i].parent_targete < 0 ? 'text-danger' : 'text-success'}">المستهدف(${nodes[i].targete})</span>`)+
                    // (nodes[i].parent_targete == 0 ? '' : `<span class="${nodes[i].parent_targete < 0 ? 'text-danger' : 'text-success'}">اجمالى المستهدف(${nodes[i].parent_targete})</span>`),
            "icon": "ki-solid ki-folder text-primary",
            "children": buildTree(nodes, nodes[i].above_hierarchy)
            };
            result.push(node);
        }
    }
    
    return result;
}

    $("#kt_docs_jstree_contextual").jstree({
        "core" : {
        "themes" : {
            "responsive": false
        },
        // so that create works
        "check_callback" : true,
        'data': buildTree(data, null) // Pass the updated data to build the tree
        },
        "types" : {
        "default" : {
            "icon" : "ki-solid ki-folder text-primary"
        },
        "file" : {
            "icon" : "ki-solid ki-file text-primary"
        }
        },
        "state" : { "key" : "demo2" },
        "plugins" : [ "contextmenu", "state", "types" ]
    });
});

</script> -->


@endsection
