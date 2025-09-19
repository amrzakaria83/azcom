@extends('admin.layout.master')

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .description {
            color: #7f8c8d;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .content {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .tree-container {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .employee-details {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }
        
        .tree {
            padding-left: 20px;
            max-height: 600px;
            overflow-y: auto;
        }
        
        .employee {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            background: #f8f9fa;
            border-left: 4px solid #3498db;
            transition: all 0.3s;
        }
        
        .employee:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        .employee-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .employee-name {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .employee-id {
            color: #7f8c8d;
            font-size: 0.9em;
        }
        
        .children {
            padding-left: 30px;
            margin-top: 10px;
            border-left: 2px dashed #ddd;
            display: none;
        }
        
        .children.show {
            display: block;
        }
        
        .details-content {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .detail-item {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .detail-icon {
            width: 30px;
            color: #3498db;
        }
        
        .detail-label {
            font-weight: 600;
            width: 150px;
            color: #2c3e50;
        }
        
        .detail-value {
            flex: 1;
            color: #34495e;
        }
        
        .search-box {
            margin-bottom: 20px;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s;
        }
        
        .search-box input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .search-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .stats {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .stat {
            padding: 15px;
            min-width: 150px;
        }
        
        .stat-number {
            font-size: 2em;
            font-weight: 700;
            color: #3498db;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-size: 0.9em;
        }
        
        .no-results {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        .tree-info {
            margin-top: 20px;
            padding: 10px;
            background: #e3f2fd;
            border-radius: 5px;
            font-size: 0.9em;
        }
        
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .stats {
                flex-direction: column;
            }
            
            .detail-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
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
                    <div class="stats">
            <div class="stat">
                <div class="stat-number" id="totalEmployees">0</div>
                <div class="stat-label">Total Employees</div>
            </div>
            <div class="stat">
                <div class="stat-number" id="hierarchyLevels">0</div>
                <div class="stat-label">Hierarchy Levels</div>
            </div>
            <div class="stat">
                <div class="stat-number" id="rootEmployees">0</div>
                <div class="stat-label">Root Employees</div>
            </div>
        </div>
        
        <div class="content">
            <div class="tree-container">
                <h2><i class="fas fa-sitemap"></i> Organization Tree</h2>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search employees by name or email...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="tree" id="employeeTree">
                    <div class="no-results">Loading employee data...</div>
                </div>
                <div class="tree-info">
                    <i class="fas fa-info-circle"></i> Click on an employee to expand/collapse their team and view details
                </div>
            </div>
            
            <div class="employee-details">
                <h2><i class="fas fa-user-circle"></i> Employee Details</h2>
                <div class="details-content" id="employeeDetails">
                    <div class="card">
                        <p>Select an employee from the tree to view details</p>
                    </div>
                </div>
            </div>
        </div>
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
     
        // This would be replaced with your PHP data
        // For demonstration, using sample data structure
        const data = [
            {
                id: 3,
                above_hierarchy: "3",
                emp_id: 1,
                emphier_id: 4,
                getaboveemp: {
                    id: 3,
                    name_ar: null,
                    name_en: 'bb',
                    phone: '01006287370',
                    email: 'admin4@az.com'
                },
                getemp: {
                    id: 4,
                    name_ar: null,
                    name_en: 'cc',
                    phone: '3333',
                    email: 'admin5@az.com',
                    job_title: "Manager"
                }
            },
            {
                id: 2,
                emp_id: 1,
                emphier_id: 3,
                above_hierarchy: "1",
                getemp: {
                    id: 3,
                    name_ar: null,
                    name_en: 'bb',
                    phone: '01006287370',
                    email: 'admin4@az.com',
                    job_title: "Team Lead"
                }
            },
            {
                id: 1,
                emp_id: 1,
                emphier_id: 2,
                above_hierarchy: null,
                getemp: {
                    id: 2,
                    name_ar: null,
                    name_en: 'aa',
                    phone: '01146709165',
                    email: 'admin3@az.com',
                    job_title: "Developer"
                }
            }
        ];

        const dataemp = [
            {
                id: 4,
                name_ar: null,
                name_en: "cc",
                phone: "3333",
                email: "admin5@az.com",
                address1: "Elgomhoriaa Street",
                birth_date: "2000-09-05",
                gender: 0,
                job_title: "Manager",
                work_date: "2025-09-09"
            },
            {
                id: 3,
                name_ar: null,
                name_en: 'bb',
                phone: '01006287370',
                email: 'admin4@az.com',
                job_title: "Team Lead"
            },
            {
                id: 2,
                name_ar: null,
                name_en: 'aa',
                phone: '01146709165',
                email: 'admin3@az.com',
                job_title: "Developer"
            },
            {
                id: 1,
                name_ar: 'رئيسي',
                name_en: 'Super Admin',
                phone: '***********',
                email: 'admin1@az.com',
                job_title: "Administrator"
            }
        ];

        // Build the hierarchy tree
        function buildTree(nodes) {
            const nodeMap = {};
            const roots = [];
            
            // First pass: create all nodes
            nodes.forEach(node => {
                nodeMap[node.id] = {
                    ...node,
                    children: []
                };
            });
            
            // Second pass: link children to parents
            nodes.forEach(node => {
                const parentId = node.above_hierarchy;
                if (parentId && nodeMap[parentId] && parentId != node.id) {
                    nodeMap[parentId].children.push(nodeMap[node.id]);
                } else if (!parentId || parentId === "null" || parentId === 0) {
                    roots.push(nodeMap[node.id]);
                }
            });
            
            return roots;
        }

        // Calculate tree statistics
        function calculateTreeStats(tree) {
            let totalEmployees = 0;
            let maxDepth = 0;
            
            function countNodes(node, depth) {
                if (!node) return;
                
                totalEmployees++;
                maxDepth = Math.max(maxDepth, depth);
                
                if (node.children && node.children.length) {
                    node.children.forEach(child => {
                        countNodes(child, depth + 1);
                    });
                }
            }
            
            tree.forEach(root => {
                countNodes(root, 1);
            });
            
            return {
                total: totalEmployees,
                depth: maxDepth,
                roots: tree.length
            };
        }

        // Render the tree
        function renderTree(node, container) {
            const employeeElement = document.createElement('div');
            employeeElement.className = 'employee';
            employeeElement.setAttribute('data-id', node.id);
            employeeElement.setAttribute('data-name', node.getemp ? node.getemp.name_en : 'Unknown');
            employeeElement.setAttribute('data-email', node.getemp ? node.getemp.email : '');
            
            const employeeHeader = document.createElement('div');
            employeeHeader.className = 'employee-header';
            employeeHeader.innerHTML = `
                <div>
                    <div class="employee-name">${node.getemp ? node.getemp.name_en : 'Unknown'}</div>
                    <div class="employee-id">ID: ${node.id} | ${node.getemp ? node.getemp.email : ''}</div>
                </div>
                <div>${node.children && node.children.length ? '<i class="fas fa-chevron-down"></i>' : ''}</div>
            `;
            
            employeeElement.appendChild(employeeHeader);
            
            const childrenContainer = document.createElement('div');
            childrenContainer.className = 'children';
            
            if (node.children && node.children.length) {
                node.children.forEach(child => {
                    renderTree(child, childrenContainer);
                });
            }
            
            employeeElement.appendChild(childrenContainer);
            container.appendChild(employeeElement);
            
            // Add click event to show details and toggle children
            employeeHeader.addEventListener('click', () => {
                showEmployeeDetails(node);
                
                // Toggle children visibility
                if (childrenContainer.classList.contains('show')) {
                    childrenContainer.classList.remove('show');
                    if (employeeHeader.querySelector('i')) {
                        employeeHeader.querySelector('i').className = 'fas fa-chevron-down';
                    }
                } else {
                    childrenContainer.classList.add('show');
                    if (employeeHeader.querySelector('i')) {
                        employeeHeader.querySelector('i').className = 'fas fa-chevron-up';
                    }
                }
            });
        }

        // Show employee details
        function showEmployeeDetails(employee) {
            const detailsContainer = document.getElementById('employeeDetails');
            const emp = dataemp.find(e => e.id === employee.emphier_id) || employee.getemp || {};
            
            detailsContainer.innerHTML = `
                <div class="card">
                    <h3>${emp.name_en || 'Unknown'}</h3>
                    <p>${emp.job_title || 'No title'}</p>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-id-card"></i></div>
                    <div class="detail-label">Employee ID:</div>
                    <div class="detail-value">${employee.id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-envelope"></i></div>
                    <div class="detail-label">Email:</div>
                    <div class="detail-value">${emp.email || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-phone"></i></div>
                    <div class="detail-label">Phone:</div>
                    <div class="detail-value">${emp.phone || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="detail-label">Address:</div>
                    <div class="detail-value">${emp.address1 || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-birthday-cake"></i></div>
                    <div class="detail-label">Birth Date:</div>
                    <div class="detail-value">${emp.birth_date || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-venus-mars"></i></div>
                    <div class="detail-label">Gender:</div>
                    <div class="detail-value">${emp.gender === 0 ? 'Male' : 'Female'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-icon"><i class="fas fa-calendar-day"></i></div>
                    <div class="detail-label">Work Date:</div>
                    <div class="detail-value">${emp.work_date || 'N/A'}</div>
                </div>
            `;
        }

        // Initialize the application
        function initApp() {
            const treeContainer = document.getElementById('employeeTree');
            const searchInput = document.getElementById('searchInput');
            
            // Check if required elements exist
            if (!treeContainer || !searchInput) {
                console.error("Required DOM elements not found");
                return;
            }
            
            const tree = buildTree(data);
            
            // Calculate and display statistics
            const stats = calculateTreeStats(tree);
            document.getElementById('totalEmployees').textContent = stats.total;
            document.getElementById('hierarchyLevels').textContent = stats.depth;
            document.getElementById('rootEmployees').textContent = stats.roots;
            
            // Clear loading message
            treeContainer.innerHTML = '';
            
            // Render the tree
            tree.forEach(root => {
                renderTree(root, treeContainer);
            });
            
            // Add search functionality
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();
                const employees = document.querySelectorAll('.employee');
                let visibleCount = 0;
                
                employees.forEach(emp => {
                    const name = emp.getAttribute('data-name').toLowerCase();
                    const email = emp.getAttribute('data-email').toLowerCase();
                    
                    if (searchTerm === '' || name.includes(searchTerm) || email.includes(searchTerm)) {
                        emp.style.display = 'block';
                        visibleCount++;
                    } else {
                        emp.style.display = 'none';
                    }
                });
                
                // Show no results message if needed
                if (visibleCount === 0 && searchTerm !== '') {
                    treeContainer.innerHTML = '<div class="no-results">No employees match your search</div>';
                } else if (treeContainer.innerHTML.includes('no-results') && searchTerm === '') {
                    treeContainer.innerHTML = '';
                    tree.forEach(root => {
                        renderTree(root, treeContainer);
                    });
                }
            });
        }

        // Initialize the app when the page is fully loaded
        window.addEventListener('load', initApp);
    
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
