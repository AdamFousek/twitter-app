import React, {useEffect} from 'react';
import TweetItem from "./TweetItem";

function TweetList(props) {
    const tweets = props.tweets.map(tweet => (
        <TweetItem tweet={tweet} key={tweet.id} />
    ));
    return (
        <div className="row">
            {tweets}
        </div>
    );
}

export default TweetList;
