
import http from 'k6/http';
import { check, sleep } from 'k6';
import { SharedArray } from 'k6/data';
import { ENDPOINTS } from './config.js';

const users = new SharedArray('users', function () {
    return JSON.parse(open('./users.json')).users;
});

export const options = {
    scenarios: {
        normal_load: {
            executor: 'constant-arrival-rate',
            rate: 50, // 50 TPS
            timeUnit: '1s',
            duration: '2m',
            preAllocatedVUs: 10,
            maxVUs: 20,
            exec: 'main',
        },
        peak_load: {
            executor: 'constant-arrival-rate',
            rate: 200, // 200 TPS
            timeUnit: '1s',
            duration: '1m',
            preAllocatedVUs: 50,
            maxVUs: 70,
            // startTime: '30m', // Start after normal_load
            exec: 'main',
        },
    },
    thresholds: {
        http_req_failed: ['rate<0.01'],
        http_req_duration: ['p(95)<500'],
    },
};

export function main() {
    const user = users[Math.floor(Math.random() * users.length)];

    // Step 1: GET the login page to retrieve the CSRF token
    const pageRes = http.get(ENDPOINTS.LOGIN_PAGE);
    const csrfToken = pageRes.html().find('input[name=_token]').val();

    // Step 2: POST to the login endpoint with the CSRF token
    const loginRes = http.post(ENDPOINTS.LOGIN, {
        name: user.name,
        password: 'qwe',
        _token: csrfToken,
    });

    check(loginRes, {
        'login successful': (res) => res.status === 200 && res.url.includes('dashboard'),
    });

    if (loginRes.status === 200) {
        // Successful login usually results in a redirect.
        // We can follow up with requests to protected pages.
        http.get(ENDPOINTS.DASHBOARD);
        sleep(2);
        http.get(ENDPOINTS.BOOKS);
        sleep(1);
        http.get(ENDPOINTS.MEMBERS);
    }

    sleep(1);
}
