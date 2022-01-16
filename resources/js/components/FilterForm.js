import React, {useState} from 'react';

function FilterForm(props) {
    const [search, setSearch] = useState('');
    const onSubmitHandler = (e) => {
        e.preventDefault();
        // Check if user wrote something
        if (search.trim().length === 0) {
            return;
        }
        const filter = [...props.filter];
        // Check if already in filter
        if (filter.includes(search)) {
            return;
        }
        // push item into array
        filter.push(search);
        // set filter
        props.setFilter(filter);
        // clear input
        setSearch('');
    }
    const setSearchHandler = (e) => {
        setSearch(oldSearch => {
            return e.target.value;
        })
    }
    return (
        <form onSubmit={onSubmitHandler}>
            <label htmlFor="search" className="form-label">Searching phrase</label>
            <input type="text" name="search" className="form-control" id="search" value={search} onInput={setSearchHandler} />
            <button type="submit" className="btn btn-primary my-2">Search</button>
        </form>
    );
}

export default FilterForm;
