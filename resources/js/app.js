require('./bootstrap');
import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import TweetList from "./components/TweetList";
import Filter from "./components/Filter";

function App() {
    const [filter, setFilter] = useState([]);
    const [tweets, setTweets] = useState([]);

    // Function for setting filter
    const setFilterHandler = async (filter) => {
        setFilter(filter);
        await fetchTweets(filter);
    }
    // Get tweets from server
    const fetchTweets = filter => {
        // if there is no filter, then do not send request and reset tweets
        if (filter.length === 0) {
            setTweets([]);
            return;
        }
        // Set query parameters for endpoint
        axios.get('/api/', {params: {search: filter.join(',')}})
            .then(response => {
                if (response.data.meta.result_count > 0) {
                    const users = response.data.includes.users;
                    const tweets = response.data.data.map(tweet => {
                        const t = {
                            ...tweet,
                            author: users.find(user => user.id === tweet.author_id)
                        }
                        return t;
                    });
                    setTweets(tweets);
                }
            }).catch(error => {
                console.log(error);
            });
    };

    return (
        <div className="container">
            <h1>Tweets</h1>
            <div className="row">
                <div className="col">
                    <Filter filter={filter} setFilter={setFilterHandler} />
                </div>
            </div>
            <div className="row">
                <div className="col">
                    <TweetList tweets={tweets} />
                </div>
            </div>
        </div>
    );
}

ReactDOM.render(<App/>, document.getElementById('root'))
