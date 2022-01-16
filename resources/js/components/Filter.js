import React from 'react';
import FilterForm from "./FilterForm";

function Filter(props) {
    const removeFilterItemHandler = (filterItem) => {
        const filter = [...props.filter];
        const itemIndex = filter.indexOf(filterItem);
        if (itemIndex !== -1) {
            filter.splice(itemIndex, 1);
        }
        props.setFilter(filter);
    };
    const activeFilters = props.filter.map(filter => (
        <div className="col" key={filter}>
            <span title="Remove item" className="badge bg-success" onClick={() => {removeFilterItemHandler(filter)} }>{filter}</span>
        </div>
    ));

    return (
        <div className="row">
            <div className="col-6">
                <FilterForm setFilter={props.setFilter} filter={props.filter}/>
            </div>
            <div className="col-4">
                <div className="row row-cols-auto">
                    {activeFilters}
                </div>
            </div>
        </div>
    );
}

export default Filter;
