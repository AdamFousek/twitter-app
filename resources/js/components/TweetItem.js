import React from 'react';

function TweetItem(props) {
    const tweet = props.tweet;
    return (
        <div className="col-5 my-3">
            <div className="card">
                <div className="card-header">
                    {tweet.author.name} <small>@{tweet.author.username}</small>
                </div>
                <div className="card-body">
                    <p className="card-text">{tweet.text}</p>
                </div>
                <div className="card-body">
                    <a href={"https://twitter.com/" + tweet.author.username + "/status/" + tweet.id}
                       className="card-link"
                       target="_blank">
                        Show tweet
                    </a>
                </div>
            </div>
        </div>
    );
}

export default TweetItem;
