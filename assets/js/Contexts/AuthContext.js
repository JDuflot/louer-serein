import React, { createContext } from 'react'

export default createContext({
    currentUser: null,
    setCurrentUser: () => {},
    logout: () => {}
});