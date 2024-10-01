export const is404 = function (err){
    return responseWithStatus(err) && 404 === err.response.status ;
}

export const is422 = function (error){
    return 422 === error.response.status ;
}

const responseWithStatus =function (err){
    return err.response && err.response.status ;
}
