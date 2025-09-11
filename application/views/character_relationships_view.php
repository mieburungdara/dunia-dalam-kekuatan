<div class="container mt-4">
    <h1>Visualisasi Relasi Karakter</h1>

    <div class="mb-3">
        <label for="relationshipFilter" class="form-label">Filter by Relationship Type:</label>
        <select class="form-select" id="relationshipFilter">
            <option value="all">All Types</option>
        </select>
    </div>

    <div class="row mb-3">
        <div class="col-md-5">
            <label for="startNode" class="form-label">Start Character:</label>
            <select class="form-select" id="startNode">
                <option value="">Select Character</option>
            </select>
        </div>
        <div class="col-md-5">
            <label for="endNode" class="form-label">End Character:</label>
            <select class="form-select" id="endNode">
                <option value="">Select Character</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100" id="findPathBtn">Find Path</button>
        </div>
    </div>

    <div id="mynetwork" style="height: 600px; border: 1px solid lightgray;"></div>
</div>

<script type="text/javascript" src="https://unpkg.com/vis-network/standalone/vis-network.min.js"></script>
<script type="text/javascript">
    var allNodes = new vis.DataSet(<?php echo $nodes; ?>);
    var allEdges = new vis.DataSet(<?php echo $edges; ?>);

    var container = document.getElementById('mynetwork');
    var data = {
        nodes: allNodes,
        edges: allEdges
    };
    var options = {
        nodes: {
            shape: 'dot',
            size: 16
        },
        physics: {
            forceAtlas2Based: {
                gravitationalConstant: -26,
                centralGravity: 0.005,
                springLength: 230,
                springConstant: 0.18
            },
            maxVelocity: 146,
            solver: 'forceAtlas2Based',
            stabilization: {
                enabled: true,
                iterations: 2000,
                updateInterval: 25
            }
        },
        edges: {
            arrows: 'to',
            color: '#848484',
            font: {
                align: 'middle'
            }
        }
    };
    var network = new vis.Network(container, data, options);

    // Populate filter dropdown
    var filterSelect = document.getElementById('relationshipFilter');
    var uniqueTypes = new Set();
    allEdges.forEach(function(edge) {
        uniqueTypes.add(edge.label);
    });

    uniqueTypes.forEach(function(type) {
        var option = document.createElement('option');
        option.value = type;
        option.textContent = type;
        filterSelect.appendChild(option);
    });

    // Filter logic
    filterSelect.addEventListener('change', function() {
        var selectedType = this.value;
        var filteredEdges;

        if (selectedType === 'all') {
            filteredEdges = allEdges;
        } else {
            filteredEdges = allEdges.filter(function(edge) {
                return edge.label === selectedType;
            });
        }
        network.setData({ nodes: allNodes, edges: filteredEdges });
    });

    // Populate character selection dropdowns
    var startNodeSelect = document.getElementById('startNode');
    var endNodeSelect = document.getElementById('endNode');
    allNodes.forEach(function(node) {
        var option1 = document.createElement('option');
        option1.value = node.id;
        option1.textContent = node.label;
        startNodeSelect.appendChild(option1);

        var option2 = document.createElement('option');
        option2.value = node.id;
        option2.textContent = node.label;
        endNodeSelect.appendChild(option2);
    });

    // Pathfinding logic (BFS)
    document.getElementById('findPathBtn').addEventListener('click', function() {
        var startNodeId = startNodeSelect.value;
        var endNodeId = endNodeSelect.value;

        if (!startNodeId || !endNodeId) {
            alert('Please select both start and end characters.');
            return;
        }

        // Reset highlighting
        var updatedNodes = allNodes.map(node => ({ ...node, color: undefined, font: undefined }));
        var updatedEdges = allEdges.map(edge => ({ ...edge, color: '#848484', width: undefined }));
        network.setData({ nodes: updatedNodes, edges: updatedEdges });

        if (startNodeId === endNodeId) {
            alert('Start and end characters are the same.');
            return;
        }

        var queue = [];
        var visited = new Set();
        var parents = {}; // To reconstruct path

        queue.push(startNodeId);
        visited.add(startNodeId);
        parents[startNodeId] = null;

        var pathFound = false;

        while (queue.length > 0) {
            var currentNodeId = queue.shift();

            if (currentNodeId === endNodeId) {
                pathFound = true;
                break;
            }

            allEdges.forEach(function(edge) {
                if (edge.from === currentNodeId && !visited.has(edge.to)) {
                    visited.add(edge.to);
                    parents[edge.to] = { node: currentNodeId, edgeId: edge.id };
                    queue.push(edge.to);
                }
            });
        }

        if (pathFound) {
            var pathNodes = new Set();
            var pathEdges = new Set();
            var current = endNodeId;

            while (current !== null) {
                pathNodes.add(current);
                if (parents[current] && parents[current].edgeId) {
                    pathEdges.add(parents[current].edgeId);
                }
                current = parents[current] ? parents[current].node : null;
            }

            // Apply highlighting
            updatedNodes = allNodes.map(node => {
                if (pathNodes.has(node.id)) {
                    return { ...node, color: { background: '#FFD700', border: '#FFA500' }, font: { color: '#000000' } };
                }
                return node;
            });

            updatedEdges = allEdges.map(edge => {
                if (pathEdges.has(edge.id)) {
                    return { ...edge, color: '#FF4500', width: 3 };
                }
                return edge;
            });

            network.setData({ nodes: updatedNodes, edges: updatedEdges });
        } else {
            alert('No path found between selected characters.');
        }
    });
</script>