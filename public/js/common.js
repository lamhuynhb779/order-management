function convertStateName(stateId)
{
    if (stateId === 1) {
        return 'Created';
    }
    if (stateId === 2) {
        return 'Waiting confirm';
    }
    if (stateId === 3) {
        return 'Confirmed';
    }
    if (stateId === 4) {
        return 'Shipping';
    }
    if (stateId === 5) {
        return 'Arrived';
    }
    if (stateId === 6) {
        return 'Delivered';
    }
    if (stateId === 7) {
        return 'Cancelled';
    }

    return 'Unknown';
}
