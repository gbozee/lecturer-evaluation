angular.module('app')
    .directive('d3Bars', ['$window', '$timeout',
        function($window, $timeout) {
            return {
                restrict: 'A',
                scope: {
                    data: '=',
                    label: '@',
                    onClick: '&'
                },
                link: function(scope, ele, attrs) {
                        var renderTimeout;
//                        var margin = parseInt(attrs.margin) || 20,
//                            barHeight = parseInt(attrs.barHeight) || 20,
//                            barPadding = parseInt(attrs.barPadding) || 5;

                    var svg = d3.select(ele[0])
                        .append('svg')
                        .style('width', '100%');

                    function render(){
                        var margin = {top: 20, right: 20, bottom: 30, left: 40},
                            width = 960 - margin.left - margin.right,
                            height = 500 - margin.top - margin.bottom;

                        var x = d3.scale.ordinal()
                            .rangeRoundBands([0, width], .1);

                        var y = d3.scale.linear()
                            .range([height, 0]);

                        var xAxis = d3.svg.axis()
                            .scale(x)
                            .orient("bottom");

                        var yAxis = d3.svg.axis()
                            .scale(y)
                            .orient("left")
                            .ticks(10, "%");

                        var svg = d3.select(ele[0])
                            .append('svg')
                            .attr("width", width + margin.left + margin.right)
                            .attr("height", height + margin.top + margin.bottom)
                            .append("g")
                            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                        x.domain(data.map(function(d) { return d.name; }));
                        y.domain([0, d3.max(data, function(d) { return d.score; })]);

                        svg.append("g")
                            .attr("class", "x axis")
                            .attr("transform", "translate(0," + height + ")")
                            .call(xAxis);

                        svg.append("g")
                            .attr("class", "y axis")
                            .call(yAxis)
                            .append("text")
                            .attr("transform", "rotate(-90)")
                            .attr("y", 6)
                            .attr("dy", ".71em")
                            .style("text-anchor", "end")
                            .text("Frequency");

                        svg.selectAll(".bar")
                            .data(data)
                            .enter().append("rect")
                            .attr("class", "bar")
                            .attr("x", function(d) { return x(d.name); })
                            .attr("width", x.rangeBand())
                            .attr("y", function(d) { return y(d.score); })
                            .attr("height", function(d) { return height - y(d.score); });
                    }

                        $window.onresize = function() {
                            scope.$apply();
                        };
//
                        scope.$watch(function() {
                            return angular.element($window)[0].innerWidth;
                        }, function() {
                            scope.render(scope.data);
                        });
//
                        scope.$watch('data', function(newData) {
                            scope.render(newData);
                        }, true);
//
                        scope.render = function(data) {
                            svg.selectAll('*').remove();

                            if (!data) return;
                            if (renderTimeout) clearTimeout(renderTimeout);

//                            renderTimeout = $timeout(
//                                function() {
//                                var width = d3.select(ele[0])[0][0].offsetWidth - margin,
//                                    height = scope.data.length * (barHeight + barPadding),
//                                    color = d3.scale.category20(),
//                                    xScale = d3.scale.linear()
//                                        .domain([0, d3.max(data, function(d) {
//                                            return d.score;
//                                        })])
//                                        .range([0, width]);
//
//                                svg.attr('height', height);
//
//                                svg.selectAll('rect')
//                                    .data(data)
//                                    .enter()
//                                    .append('rect')
//                                    .on('click', function(d,i) {
//                                        return scope.onClick({item: d});
//                                    })
//                                    .attr('height', barHeight)
//                                    .attr('width', 140)
//                                    .attr('x', Math.round(margin/2))
//                                    .attr('y', function(d,i) {
//                                        return i * (barHeight + barPadding);
//                                    })
//                                    .attr('fill', function(d) {
//                                        return color(d.score);
//                                    })
//                                    .transition()
//                                    .duration(1000)
//                                    .attr('width', function(d) {
//                                        return xScale(d.score);
//                                    });
//                                svg.selectAll('text')
//                                    .data(data)
//                                    .enter()
//                                    .append('text')
//                                    .attr('fill', '#fff')
//                                    .attr('y', function(d,i) {
//                                        return i * (barHeight + barPadding) + 15;
//                                    })
//                                    .attr('x', 15)
//                                    .text(function(d) {
//                                        return d.name + " (scored: " + d.score + ")";
//                                    });
//                            }, 200);
                            renderTimeout = $timeout(render,200);
                        };

                }}
        }]);